<x-layout :title="$title">
<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-7 col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Set a new password</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="new-password">Password</label>
                            <span class="input-group">
                                <input type="password" class="form-control"
                                       minlength="8"
                                       maxlength="75"
                                       placeholder="Password"
                                       id="new-password" name="password" required
                                       autocomplete="new-password" autofocus>
                                <span class="input-group-btn">
                                    <x-show-password-button passwordInputId="new-password" />
                                </span>
                                </span>
                            @error('password')
                            <x-form-error-message :message="$message" />
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm password</label>
                            <span class="input-group">
                            <input type="password" class="form-control"
                                   minlength="8"
                                   maxlength="75"
                                   placeholder="Confirm password"
                                   id="confirm-password" name="password_confirmation" required>
                                <span class="input-group-btn">
                                    <x-show-password-button passwordInputId="confirm-password" />
                                </span>
                            </span>
                        </div>
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success w-100">Save my password</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layout>
