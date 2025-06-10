<x-guest-layout>
    <div>
        <div class="text-center mb-6">
            <img src="{{ asset('img/NesaFood Logo.png') }}"class="h-16 mx-auto">
            <h2 class="text-2xl font-bold text-green-700 mt-4">Selamat Datang di NesaFood</h2>
            <p class="text-sm text-gray-500">Masuk untuk mulai memesan makanan favoritmu</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ url('/auth/login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                              :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-orange-600 hover:underline" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Button -->
            <div>
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200">
                    Masuk
                </button>
            </div>
        </form>

        <p class="mt-6 text-sm text-center text-gray-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-orange-600 hover:underline font-medium">Daftar sekarang</a>
        </p>
    </div>
</x-guest-layout>
