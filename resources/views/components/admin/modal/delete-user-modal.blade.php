<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <p class="font-weight-bolder">ALL USER'S POSTS AND MESSAGES WILL BE DELETED AS WELL</p>
                    <span>This action is irreversible!</span>
                </div>
                <div class="form-group">
                    <label for="confirmation">Type <code>DELETE</code> to delete the user</label>
                <input class="form-control" type="text" id="confirmation" form="deleteUserModalForm" required pattern="^DELETE$"
                       autocomplete="off">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <form method="post" action="#" id="deleteUserModalForm">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
