<section>
    <header>
        <h3 class=" font-medium text-gray-900">
            Profile Information
        </h3>

        <p class="mt-1 text-sm text-secondary">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Click here to re-send the verification email.
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    A new verification link has been sent to your email address.
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="d-flex gap-4">
            <button type="submit" class="btn btn-primary m-auto">Save</button>

            @if (session('status') == 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">Saved.</p>
            @endif
        </div>
    </form>
</section>