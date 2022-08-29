<x-admin.layout :title="$title" back-button-available="true">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-2">
    <x-session-alerts />
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-header">
                        <div class="h4">Edit a ban</div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ @route('admin.bans.update', ['id' => $ban->id]) }}">
                            <div class="form-group">
                                User ID: <input type="text" class="form-control" disabled value="{{ $user->id }}">
                                User nickname: <input type="text" class="form-control" disabled value="{{ $user->username }}">
                                User email: <input type="text" class="form-control" disabled value="{{ $user->email }}">
                                User full name: <input type="text" class="form-control" disabled value="{{ $user->name }}">
                            </div>
                            <div class="form-group mt">
                                <label for="bannedUntil" class="font-weight-bolder">Banned until: </label>
                                <input type="date" class="form-control" name="banned_until" id="bannedUntil"
                                       value="{{ $ban->banned_until->toDateString() }}" min="{{ now()->toDateString() }}" required>
                                @error('banned_until')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="reason" class="font-weight-bolder">Reason:</label>
                                <textarea id="reason" maxlength="160" class="form-control" name="reason" required>{{ $ban->reason }}</textarea>
                                @error('reason')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="form-control btn   btn-success">
                                    Update ban
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-admin.layout>
