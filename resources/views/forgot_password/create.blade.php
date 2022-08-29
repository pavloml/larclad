<x-layout title="Reset password">
<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-7 col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Forgot password</h3>
            </div>
            <div class="card-body">
                <form method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" autofocus>
                        </div>
                        @error('email')
                        <x-form-error-message :message="$message" />
                        @enderror
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-success">Reset my password</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layout>
