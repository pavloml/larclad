<div class="modal fade" id="deleteCityModal" tabindex="-1" role="dialog" aria-labelledby="deleteCityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCityModalLabel">Delete city</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <p class="font-weight-bolder">You can delete city only if it doesn't have any associated posts</p>
                    <span>This action is irreversible!</span>
                </div>
                <p class="text-center h4">Are you sure?</p>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <form method="post" action="#" id="deleteCityModalForm">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
