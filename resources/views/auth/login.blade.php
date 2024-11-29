<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm ">
        @csrf
        <!-- Email Address -->
        <div class="mb-4">
            <x-text-input id="email" class="block w-full border border-gray-300 px-4 py-2 rounded-md focus:ring focus:ring-red-400" type="email" name="email" placeholder="masukkan email anda" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-text-input id="password" class="block w-full border border-gray-300 px-4 py-2 rounded-md focus:ring focus:ring-red-400" type="password" name="password" placeholder="masukkan password anda" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="w-full bg-red-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-600">
                Masuk
            </button>
        </div>
        <p class="flex justify-end">Belum punya akun? <span> <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700"> Register</a></span></p>
    </form>
</x-guest-layout>
