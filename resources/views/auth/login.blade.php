<x-guest-layout>
    <!-- Session Status -->

    <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-label for="email" :value="__('Email')" required />
            <x-text-input id="email"
                class="block w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-200"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-error-message for="email" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-label for="password" :value="__('Password')" required />

            <x-text-input id="password"
                class="block w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-200"
                type="password" name="password" required autocomplete="current-password" />

            <x-error-message for="password" />
        </div>

        <div class="flex items-center justify-end">
            <x-btn-primary
                class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium shadow-md hover:shadow-lg transition duration-200 transform hover:-translate-y-0.5">
                {{ __('Log in') }}
            </x-btn-primary>
        </div>
    </form>
</x-guest-layout>
