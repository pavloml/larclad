<x-layout :title="$title">
    <x-profile-header/>
    <div class="row">
        <div class="col-12 col-md-3">
                <x-profile-settings-menu />
        </div>
        <div class="col-12 col-md-6 mt-3 mt-md-0">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Change email</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ @route('profile.email.store') }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="email">New email</label>
                                <input type="email" class="form-control" placeholder="Email" id="email" name="email"
                                       value="{{ old('email') ?: $user->email}}" required>
                            @error('email')
                            <x-form-error-message :message="$message"/>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="current-password">Current password</label>
                            <span class="input-group">
                                <input type="password" class="form-control"
                                       minlength="8"
                                       maxlength="75"
                                       placeholder="Password"
                                       id="current-password" name="current-password" required
                                       autocomplete="current-password">
                                <span class="input-group-btn">
                                    <x-show-password-button passwordInputId="current-password"/>
                                </span>
                            </span>
                            @error('password')
                            <x-form-error-message :message="$message" />
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success w-100">Change email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>

