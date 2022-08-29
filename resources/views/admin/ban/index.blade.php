<x-admin.layout :title="$title">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-1">
        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Bans</h1>
        </div>
        <x-session-alerts />


        @if(!$bans->isEmpty())
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <x-sortable-link column_id="id" column_name="ID"
                                         :active_column="$sort['column']"
                                         :active_direction="$sort['direction']"/>
                    </th>
                    <th>
                        <x-sortable-link column_id="user_id" column_name="User id"
                                         :active_column="$sort['column']"
                                         :active_direction="$sort['direction']" />
                    </th>
                    <th>Reason</th>
                    <th>
                        <x-sortable-link column_id="banned_until" column_name="Expires on"
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
                @foreach($bans as $ban)
                    <tr>
                        <td>{{ $ban->id }}</td>
                        <td>{{ $ban->user_id }}</td>
                        <td>{{ $ban->reason }}</td>
                        <td><x-time :time="$ban->banned_until" /></td>
                        <td><x-time :time="$ban->created_at" /></td>
                        <td>
                            <a class="btn btn-info" href="{{ route('admin.bans.edit', ['id' => $ban->id]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger" aria-label="Delete"
                                    data-toggle="modal"
                                    data-target="#deleteBanModal"
                                    data-action-link="{{ route('admin.bans.delete', ['id' => $ban->id]) }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                <div class="col-xs-12">
                    {{ $bans->onEachSide(0)->links() }}
                </div>
            </div>
        @else
            <div class="col-xs-12 text-center">
                <p class="h1 text-danger">No bans found</p>
            </div>
        @endif
    </main>
        <x-admin.modal.delete-ban-modal />
        @push('scripts')
            <script>
                $('#deleteBanModal').on('show.bs.modal', function (event) {
                    let button = $(event.relatedTarget)
                    document.querySelector('#deleteBanModalForm').setAttribute('action', button.data('action-link'));
                })
            </script>
        @endpush
</x-admin.layout>
