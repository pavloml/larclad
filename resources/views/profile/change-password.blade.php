<x-layout :title="$title">
    <x-profile-header/>
    <div class="row">
        <div class="col-12 col-md-3">
                <x-profile-settings-menu />
        </div>
        <div class="col-12 col-md-6 mt-3 mt-md-0">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Change password</h3>
                </div>
                <div class="card-body">
                    <p>You will be logged out on other devices after changing your password</p>
                    <form method="post" action="{{ @route('profile.password.store') }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="current-password">Current password</label>
                            <span class="input-group">
                                <input type="password" class="form-control"
                                       minlength="8"
                                       maxlength="75"
                                       placeholder="Password"
                                       id="current-password"
                                       name="current-password"
                                       required
                                       autocomplete="current-password">
                                <span class="input-group-btn">
                                    <x-show-password-button passwordInputId="current-password" />
                                </span>
                                </span>
                            @error('current-password')
                            <x-form-error-message :message="$message" />
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new-password">Password</label>
                            <span class="input-group">
                                <input type="password" class="form-control"
                                       minlength="8"
                                       maxlength="75"
                                       placeholder="Password"
                                       id="new-password" name="password" required
                                       autocomplete="new-password">
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
                        <button type="submit" class="btn btn-success w-100">Change password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>

