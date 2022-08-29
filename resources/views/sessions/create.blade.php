<x-layout :title="$title">
    <x-session-alerts />
<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-7 col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Please log in</h3>
            </div>
            <div class="card-body">
                <form method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                            autocomplete="username" autofocus value="{{ old('email') }}">
                        </div>
                        @error('email')
                        <x-form-error-message :message="$message" />
                        @enderror
                        <div class="form-group">
                            <label for="current-password">Password</label>
                            <span class="input-group">
                                <input type="password" class="form-control"
                                       minlength="8"
                                       maxlength="75"
                                       placeholder="Password"
                                       id="current-password" name="password" required
                                       autocomplete="current-password">
                                <span class="input-group-btn">
                                    <x-show-password-button passwordInputId="current-password" />
                                </span>
                            </span>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="true"> Remember Me
                            </label>
                        </div>
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-success w-100">Log in</button>
                            <p class="text-center my-2">
                                <a href="{{ @url('/forgot_password') }}">Forgot your password?</a>
                            </p>
                            <p class="text-center">
                                Don't have an account? <a href="{{ @url('/register') }}">Register now!</a>
                            </p>
                        </div>
                        @if(config('app.features.social_login'))
                        <div class="login-or">
                            <hr class="hr-or">
                            <span class="span-or">or</span>
                        </div>
                        <x-sign-via />
                        @endif
                </form>
            </div>
        </div>
    </div>
</div>
</x-layout>
