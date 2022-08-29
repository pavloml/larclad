<div class="modal" id="unauthenticatedUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-info">
                    In order to message the author you need to <a href="{{ @route('login') }}">log in</a>.
                    If you don't have an account you can create it using <a href="{{ @route('register') }}">this link</a>.
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
