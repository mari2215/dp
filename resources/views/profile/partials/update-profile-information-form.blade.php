<section>
    <header>
        <h3 class=" font-medium text-gray-900">
            Інформація профілю
        </h3>

        <p class="mt-1 text-sm text-secondary">
            Оновіть інформацію профіля та пошту.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">Ім'я</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Пошта</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" readonly />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="d-flex gap-4">
            <button type="submit" class="btn btn-primary">Зберегти</button>

            @if (session('status') == 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">Збережено.</p>
            @endif
        </div>
    </form>
</section>