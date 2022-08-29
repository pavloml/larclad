<div class="modal fade" id="deleteBanModal" tabindex="-1" role="dialog" aria-labelledby="deleteBanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBanModalLabel">Delete ban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <form method="post" action="#" id="deleteBanModalForm">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
