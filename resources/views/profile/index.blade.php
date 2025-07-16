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

            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Foto Profil -->
                    <div class="flex items-start gap-4">
                        @if ($user->foto == 'profile.png')
                            <div
                                class="w-24 h-24 rounded-full bg-gray-100 border flex items-center justify-center text-gray-400 text-sm">
                                <img src="/profile.png" width="100" alt="">
                            </div>
                        @else
                            <img src="{{ asset('storage/' . $user->foto) }}" alt="Profile Photo"
                                class="w-24 h-24 rounded-full object-cover border">
                        @endif

                        <div class="flex-1">
                            <x-label for="foto" :value="__('Profile Photo')" />
                            <input type="file" name="foto" id="foto" accept="image/*"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" />
                            <x-error-message for="foto" />
                        </div>
                    </div>
                </div>

                <div>
                    <x-label for="name" :value="__('Full Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-error-message for="name" />
                </div>

                <div>
                    <x-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                        :value="old('email', $user->email)" required autocomplete="email" />
                    <x-error-message for="email" />
                </div>

                <div>
                    <x-label for="telepon" :value="__('Phone Number')" />
                    <x-text-input id="telepon" name="telepon" type="number" class="mt-1 block w-full"
                        :value="old('telepon', $user->telepon)" autocomplete="tel" />
                    <x-error-message for="telepon" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanda Tangan -->
                    <div class="flex items-start gap-4">
                        @if ($user->ttd)
                            <img src="{{ asset('storage/' . $user->ttd) }}" alt="Signature"
                                class="w-32 h-auto border rounded">
                        @else
                            <div
                                class="w-32 h-20 border rounded bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                No Signature
                            </div>
                        @endif

                        <div class="flex-1">
                            <x-label for="ttd" :value="__('Digital Signature')" />
                            <input type="file" name="ttd" id="ttd" accept="image/*"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" />
                            <x-error-message for="ttd" />
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-label for="instagram" :value="__('Instagram (optional)')" />
                        <x-text-input id="instagram" name="instagram" type="url" class="mt-1 block w-full"
                            :value="old('instagram', $user->instagram)" placeholder="https://instagram.com/username" />
                        <x-error-message for="instagram" />
                    </div>

                    <div>
                        <x-label for="tiktok" :value="__('TikTok (optional)')" />
                        <x-text-input id="tiktok" name="tiktok" type="url" class="mt-1 block w-full"
                            :value="old('tiktok', $user->tiktok)" placeholder="https://tiktok.com/@username" />
                        <x-error-message for="tiktok" />
                    </div>

                    <div>
                        <x-label for="facebook" :value="__('Facebook (optional)')" />
                        <x-text-input id="facebook" name="facebook" type="url" class="mt-1 block w-full"
                            :value="old('facebook', $user->facebook)" placeholder="https://facebook.com/username" />
                        <x-error-message for="facebook" />
                    </div>

                    <div>
                        <x-label for="web" :value="__('Website (optional)')" />
                        <x-text-input id="web" name="web" type="url" class="mt-1 block w-full"
                            :value="old('web', $user->web)" placeholder="https://yourwebsite.com" />
                        <x-error-message for="web" />
                    </div>
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

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div>
                    <x-label for="current_password" :value="__('Current Password')" />
                    <x-text-input id="current_password" name="current_password" type="password"
                        class="mt-1 block w-full" autocomplete="current-password" />
                    {{-- <x-error-message for="password" /> --}}
                    @error('current_password', 'updatePassword')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-label for="password" :value="__('New Password')" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                        autocomplete="new-password" />
                    @error('password', 'updatePassword')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror

                    {{-- <x-error-message for="password" /> --}}
                </div>

                <div>
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                        class="mt-1 block w-full" autocomplete="new-password" />
                    @error('password_confirmation', 'updatePassword')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                    {{-- <x-error-message for="password" /> --}}
                </div>

                <div class="flex items-center gap-4">
                    <x-btn-primary>Save</x-btn-primary>

                    @if (session('success') === 'Password berhasil diubah.')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">Saved.</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Card 3: Delete Account -->
        {{-- <div class="p-6">
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

                        <x-error-message for="password" />
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
        </div> --}}
    </div>
</x-app-layout>
