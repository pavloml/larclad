<x-layout :title="$title">
    <x-profile-header/>
    <div class="row">
        <div class="col-12 col-md-3">
            <x-profile-settings-menu />
        </div>
        <div class="col-12 col-md-6 mt-3 mt-md-0">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Edit profile</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        @method('PATCH')
                        @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                           id="name" name="name" value="{{ old('name', $user->name) }}"
                                           required disabled>
                                    <span class="input-group-btn">
                                            <button class="btn btn-dark"
                                                    onclick="toggleEditable(this, event, 'name')"
                                                    aria-label="Toggle editable">
                                                <i class="fas fa-unlock"></i>
                                            </button>
                                        </span>
                                </div>
                                @error('name')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" pattern="[a-zA-Z0-9_]+" id="username"
                                           name="username"
                                           value="{{ old('username') ?: $user->username}}" required disabled>
                                    <span class="input-group-btn">
                                            <button class="btn btn-dark"
                                                    onclick="toggleEditable(this, event, 'username')"
                                                    aria-label="Toggle editable">
                                                <i class="fas fa-unlock"></i>
                                            </button>
                                        </span>
                                </div>
                                @error('username')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone number</label>
                                <div class="input-group">
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                           value="{{ old('phone') ?: $user->getPhoneNumberInNANP() }}" required disabled>
                                    <span class="input-group-btn">
                                            <button class="btn btn-dark" onclick="toggleEditable(this, event, 'phone')"
                                                    aria-label="Toggle editable">
                                                <i class="fas fa-unlock"></i>
                                            </button>
                                        </span>
                                </div>
                                @error('phone')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-success" value="Save">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const toggleEditable = (button, event, elementId) => {
                event.preventDefault();
                let inputField = document.getElementById(elementId);
                if (inputField.hasAttribute('disabled')) {
                    inputField.removeAttribute('disabled');
                    button.innerHTML = '<i class="fas fa-lock"></i>';
                } else {
                    inputField.setAttribute('disabled', 'true');
                    button.innerHTML = '<i class="fas fa-unlock"></i>';
                }
            }

            const phoneInput = document.querySelector("#phone");
            phoneNumber.formatNumberInput(phoneInput);
        </script>
    @endpush
</x-layout>

