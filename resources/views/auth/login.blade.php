<x-guest-layout class="bg-orange-200">
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" style="letter-spacing: 2px; color: #f97316; font-size: 50px">
                <img class="block h-24 w-auto fill-current text-gray-600" src="{{ asset('lucymartlogo.png') }}" alt="" srcset="">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Username or email')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-yellow-600 shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3" style="background: #f97316">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        @if (Route::has('register'))
            <div class="mt-3">
                <span class="block font-medium text-sm text-gray-700">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                {{ __('Don’t have an account?') }}</a>
                </span>
            </div>
        @endif
    </x-auth-card>
</x-guest-layout>
