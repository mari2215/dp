<section>
    <header>
        <h3 class=" font-medium text-gray-900">
            Update Password
        </h3>

        <p class="mt-1 text-sm text-gray-600">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password">Current Password</label>
            <input id="update_password_current_password" class="form-control" name="current_password" type="password" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password">New Password</label>
            <input id="update_password_password" class="form-control" name="password" type="password" autocomplete="new-password" />
            @error('password', 'updatePassword')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">Confirm Password</label>
            <input id="update_password_password_confirmation" class="form-control" name="password_confirmation" type="password" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-flex gap-4">
            <button type="submit" class="btn btn-primary">Save</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Saved.</p>
            @endif
        </div>
    </form>
</section>
