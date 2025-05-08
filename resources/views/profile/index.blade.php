<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-user text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Profile</h2>
        </div>

        {{-- Breadcumb --}}
        <div class="flex gap-2 items-center">
            <i class="fi fi-rs-home text-sm"></i>
            <a href="" class="text-gray-800 text-sm gap-2">Index</a>
            {{-- <span class="text-xs">/</span>
            <i class="fi fi-rs-home"></i>
            <a href="" class="text-gray-800 text-sm">Index</a> --}}
        </div>
    </x-slot>

    <div class="my-4 bg-white border border-gray-200 rounded-lg shadow-sm">
        <!-- Card 1: Profile Information -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
            <p class="mt-1 text-sm text-gray-600">Update your account's profile information and email address.</p>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div>
                    <x-label for="nama_user" :value="__('Full Name')" />
                    <x-text-input id="nama_user" name="nama_user" type="text" class="mt-1 block w-full"
                        :value="old('nama_user', $user->nama_user)" required autofocus autocomplete="name" />
                    <x-error-message class="mt-2" :messages="$errors->get('nama_user')" />
                </div>

                <div>
                    <x-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                        :value="old('email', $user->email)" required autocomplete="email" />
                    <x-error-message class="mt-2" :messages="$errors->get('email')" />
                </div>

                <div>
                    <x-label for="telepon" :value="__('Phone Number')" />
                    <x-text-input id="telepon" name="telepon" type="number" class="mt-1 block w-full"
                        :value="old('telepon', $user->telepon)" autocomplete="tel" />
                    <x-error-message class="mt-2" :messages="$errors->get('telepon')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-btn-primary>Save</x-btn-primary>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">Saved.</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Card 2: Update Password -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Update Password</h2>
            <p class="mt-1 text-sm text-gray-600">Ensure your account is using a long, random password to stay secure.
            </p>

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div>
                    <x-label for="current_password" :value="__('Current Password')" />
                    <x-text-input id="current_password" name="current_password" type="password"
                        class="mt-1 block w-full" autocomplete="current-password" />
                    <x-error-message class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
                </div>

                <div>
                    <x-label for="password" :value="__('New Password')" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                        autocomplete="new-password" />
                    <x-error-message class="mt-2" :messages="$errors->updatePassword->get('password')" />
                </div>

                <div>
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                        class="mt-1 block w-full" autocomplete="new-password" />
                    <x-error-message class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-btn-primary>Save</x-btn-primary>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">Saved.</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Card 3: Delete Account -->
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Delete Account</h2>
            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted.
            </p>

            <div class="mt-6">
                <x-btn-danger x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">Delete
                    Account</x-btn-danger>
            </div>

            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900">Are you sure you want to delete your account?</h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please
                        enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="mt-6">
                        <x-label for="password" value="Password" class="sr-only" />

                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                            placeholder="Password" />

                        <x-error-message class="mt-2" :messages="$errors->userDeletion->get('password')" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-btn-secondary x-on:click="$dispatch('close')">
                            Cancel
                        </x-btn-secondary>

                        <x-btn-danger class="ml-3">
                            Delete Account
                        </x-btn-danger>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>
