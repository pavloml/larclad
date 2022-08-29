<div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostModalLabel">Delete post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p class="font-weight-bolder">Are you sure?</p>
                This action is irreversible
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <form method="post" action="#" id="deletePostModalForm">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
