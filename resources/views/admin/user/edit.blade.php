<x-admin.layout :title="$title" back-button-available="true">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-2">
        <x-session-alerts />
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-header">
                        <div class="h4">Edit a user</div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ @route('admin.users.update', ['id' => $user->id]) }}">
                            <div class="form-group">
                                <label>User ID:</label>
                                <input type="text" class="form-control" disabled value="{{ $user->id }}">
                            </div>
                            <div class="form-group">
                                <label>User registration date:</label>
                                <input type="text" class="form-control" disabled value="{{ $user->created_at }}">
                            </div>
                            <div class="form-group">
                                <label for="username" class="font-weight-bolder">User nickname:</label>
                                <input name="username" maxlength="30" minlength="3" id="username"
                                       type="text" class="form-control" value="{{ $user->username }}">
                                @error('username')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name" class="font-weight-bolder">User full name:</label>
                                <input name="name" maxlength="70" minlength="3"
                                       id="name" type="text" class="form-control" value="{{ $user->name }}">
                                @error('name')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bolder">User email:</label>
                                <input name="email" id="email" type="email" class="form-control" value="{{ $user->email }}">
                                @error('email')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone" class="font-weight-bolder">User phone:</label>
                                <input name="phone" id="phone" type="text" class="form-control" value="{{ $user->phone }}">
                                @error('phone')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role" class="text-danger font-weight-bolder text-uppercase">User privileges level:</label>
                                <select name="role" class="form-control" id="role" disabled>
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrator</option>
                                </select>
                            </div>
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-admin.layout>

