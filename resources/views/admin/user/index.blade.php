<x-admin.layout :title="$title">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Users</h1>
            <div class="btn-toolbar">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Search by name"
                               value="{{ request('q') }}" size="30" maxlength="140">
                        <span class="input-group-btn">
                    <button class="btn btn-default border" type="submit"><i class="fas fa-search"></i></button>
                    </span>
                    </div>
                </form>
            </div>
        </div>
        <x-session-alerts />

        @if(!$users->isEmpty())
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            <x-sortable-link column_id="id" column_name="id"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']"/>
                        </th>
                        <th>
                            <x-sortable-link column_id="username" column_name="Username"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']" />
                        </th>
                        <th>
                            <x-sortable-link column_id="name" column_name="Name"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']" />
                        </th>
                        <th>
                            <x-sortable-link column_id="email" column_name="Email"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']" />
                        </th>
                        <th>
                            <x-sortable-link column_id="created_at" column_name="Created at"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']" />
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="time-tooltip"
                                          data-toggle="tooltip"
                                          data-placement="top"
                                          title="{{$user->created_at->format('D, M j, g:i A Y T')}}"
                                          onclick="helpers.replaceText(this,'{{$user->created_at->format('D, M j, g:i A Y T')}}')">
                                        <x-time :time="$user->created_at" :diff_for_humans="true"/>
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.users.edit', ['id' => $user->id]) }}"><i class="fas fa-user-edit"></i></a>
                                <button class="btn btn-info"
                                        data-toggle="modal"
                                        data-target="#userLogModal"
                                        data-userid="{{ $user->id }}"
                                        aria-label="Activity log"><i class="fas fa-book"></i></button>
                                <a class="btn btn-danger" aria-label="Ban" href="{{ route('admin.bans.create', ['user_id' => $user->id]) }}"><i class="fas fa-ban"></i></a>
                                <button class="btn btn-danger" aria-label="Delete"
                                        data-toggle="modal"
                                        data-target="#deleteUserModal"
                                        data-action-link="{{ route('admin.users.delete', ['id' => $user->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            <div class="row justify-content-center">
                <div class="col-xs-12">
                    {{ $users->onEachSide(0)->links() }}
                </div>
            </div>
        @else
                <div class="col-xs-12 text-center">
                    <p class="h1 text-danger">No users found</p>
                    <p class="h3"><a href="{{ route('admin.users') }}">Return to the list of all users</a></p>
                </div>
    @endif
    </main>
        <x-admin.modal.delete-user-modal />
        <x-admin.modal.user-log-modal />
        @push('scripts')
            <script>
                $('#deleteUserModal').on('show.bs.modal', function (event) {
                    let button = $(event.relatedTarget);
                    document.querySelector('#deleteUserModalForm').setAttribute('action', button.data('action-link'));
                });
                $('#userLogModal').on('show.bs.modal', function (event) {
                    let button = $(event.relatedTarget);
                    let modalBody = document.querySelector('#userLogModalBody');
                    helpers.removeChildren(modalBody);

                    axios.get(`/api/admin/user_activity_log/${button.data('userid')}`)
                        .then(function (response) {
                            let sessionLogTitle = document.createElement('p');
                            sessionLogTitle.classList.add('h4', 'text-center');
                            sessionLogTitle.textContent = 'Session log';

                            let accountUpdatesLogTitle = document.createElement('p');
                            accountUpdatesLogTitle.classList.add('h4', 'text-center');
                            accountUpdatesLogTitle.textContent = 'Account updates log';

                            modalBody.append(sessionLogTitle,
                                createActivityTable(response.data.sessionsActivities),
                                accountUpdatesLogTitle,
                                createActivityTable(response.data.userUpdateActivities));

                        }).catch(function (error) {
                            alert('Error! Unable to fetch data');
                            console.log(error);
                    })
                });
            </script>
        @endpush
</x-admin.layout>
