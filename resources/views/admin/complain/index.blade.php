<x-admin.layout  :title="$title">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-1">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Complains</h1>
            <div class="btn-toolbar">
                <form method="post" action="{{ route('admin.complains.mark_reviewed_all') }}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success">
                        Mark all as reviewed
                    </button>
                </form>
            </div>
        </div>
        <x-session-alerts />


        @if(!$complains->isEmpty())
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            <x-sortable-link column_id="id" column_name="ID"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']"/>
                        </th>
                        <th>
                            <x-sortable-link column_id="post_id" column_name="Post id"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']" />
                        </th>
                        <th>Reason</th>
                        <th>
                            <x-sortable-link column_id="created_at" column_name="Created at"
                                             :active_column="$sort['column']"
                                             :active_direction="$sort['direction']" />
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($complains as $complain)
                        <tr class="{{ !$complain->is_reviewed ? 'font-weight-bolder' : '' }}">
                            <td>{{ $complain->id }}</td>
                            <td>
                                <a href="{{ route('post.show', ['id' => $complain->post_id ]) }}"
                                   target="_blank">{{ $complain->post_id }}</a>
                            </td>
                            <td>{{ $complain->reason }}</td>
                            <td><x-time :time="$complain->created_at" :diff_for_humans="true" /></td>
                            <td>
                                @if(!$complain->is_reviewed)
                                <form class="d-inline"
                                      method="post"
                                      action="{{ @route('admin.complains.mark_reviewed', ['id' => $complain->id]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button href="#" class="btn btn-success"
                                            aria-label="Mark as reviewed">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                <button class="btn btn-danger" aria-label="Delete"
                                        data-toggle="modal"
                                        data-target="#deleteComplainModal"
                                        data-action-link="{{ route('admin.complains.delete', ['id' => $complain->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            <div class="row justify-content-center">
                <div class="col-xs-12">
                    {{ $complains->onEachSide(0)->links() }}
                </div>
            </div>
        @else
                <div class="col-xs-12 text-center">
                    <p class="h1 text-danger">No complains found</p>
                </div>
    @endif
    </main>
        <x-admin.modal.delete-complain-modal />
        @push('scripts')
            <script>
                $('#deleteComplainModal').on('show.bs.modal', function (event) {
                    let button = $(event.relatedTarget)
                    document.querySelector('#deleteComplainModalForm').setAttribute('action', button.data('action-link'));
                })
            </script>
        @endpush
</x-admin.layout>
