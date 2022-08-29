<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">Delete category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <p class="font-weight-bolder">You can delete category only if it doesn't have any associated subcategories</p>
                    <span>This action is irreversible!</span>
                </div>
                <p class="text-center h4">Are you sure?</p>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <form method="post" action="#" id="deleteCategoryModalForm">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
