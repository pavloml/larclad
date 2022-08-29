<x-layout :title="$title">
<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-7 col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Register</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" minlength="3" maxlength="70" placeholder="Enter your name or company name" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <x-form-error-message :message="$message" />
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" placeholder="Enter your desired username"  pattern="[a-zA-Z0-9_]+" minlength="3" maxlength="30" id="username" name="username" value="{{ old('username') }}" required>
                            @error('username')
                            <x-form-error-message :message="$message" />
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <x-form-error-message :message="$message" />
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="tel" class="form-control" autocomplete="off" placeholder="Enter your phone number" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
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
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                            <label for="terms">I agree with the <a href="{{ @route('static.terms') }}">Terms of Use</a> and <a href="{{ @route('static.privacy') }}">Privacy Policy</a> </label>

                            @error('terms')
                            <x-form-error-message :message="$message" />
                            @enderror
                        </div>
                        @if(config('services.recaptcha.enable'))
                        <div class="form-group">
                        <div class="d-flex justify-content-center">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                        </div>

                            @error('g-recaptcha-response')
                            <x-form-error-message :message="$message" />
                            @enderror
                        </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-success w-100">Register</button>
                        </div>
                        @csrf
                        @if(config('app.features.social_login'))
                        <div class="login-or">
                            <hr class="hr-or">
                            <span class="span-or">or</span>
                        </div>
                        <x-sign-via />
                        @endif
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

</div>
    @push('scripts')
        <!-- Google reCAPTCHA -->
        <script async src='https://www.google.com/recaptcha/api.js'></script>
        <script>
            const phoneInput = document.querySelector('#phone');

            phoneNumber.formatNumberInput(phoneInput);

        </script>
    @endpush
</x-layout>
