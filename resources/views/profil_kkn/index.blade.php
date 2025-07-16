<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-hr-group text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Profil KKN</h2>
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
        <!-- Card 1: Profile KKN -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Profil KKN</h2>
        </div>

        @if ($profile == null)
            <form action="{{ route('profil-kkn.store') }}" method="POST" class="p-6 space-y-4"
                enctype="multipart/form-data">
                @csrf
                <!-- Logo -->
                <div>
                    <x-label for="logo">Logo KKN</x-label>
                    <x-text-input type="file" name="logo" id="logo" accept="image/*" class="w-full" />
                    <x-error-message for="logo" />
                </div>

                <!-- Nama Kelompok -->
                <div>
                    <x-label for="nama_kelompok" required>Nama Kelompok</x-label>
                    <x-text-input name="nama_kelompok" id="nama_kelompok" class="w-full"
                        value="{{ old('nama_kelompok', $profile->nama_kelompok ?? '') }}" />
                    <x-error-message for="nama_kelompok" />
                </div>

                <!-- Nama Desa -->
                <div>
                    <x-label for="nama_desa">Nama Desa</x-label>
                    <x-text-input name="nama_desa" id="nama_desa" class="w-full"
                        value="{{ old('nama_desa', $profile->nama_desa ?? '') }}" />
                    <x-error-message for="nama_desa" />
                </div>

                <!-- Pembimbing -->
                <div>
                    <x-label for="pembimbing_id">Pembimbing</x-label>
                    <x-select-input name="pembimbing_id" id="pembimbing_id" class="w-full">
                        <option value="">-- Pilih Pembimbing --</option>
                        @foreach ($pembimbing as $item)
                            <option value="{{ $item->id }}" @selected(old('pembimbing_id', $profile->pembimbing_id ?? '') == $item->id)>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </x-select-input>
                    <x-error-message for="pembimbing_id" />
                </div>

                <!-- Email -->
                <div>
                    <x-label for="email">Email</x-label>
                    <x-text-input name="email" id="email" type="email" class="w-full"
                        value="{{ old('email', $profile->email ?? '') }}" />
                    <x-error-message for="email" />
                </div>

                <!-- Telepon -->
                <div>
                    <x-label for="telepon">No. Telepon</x-label>
                    <x-text-input name="telepon" id="telepon" class="w-full"
                        value="{{ old('telepon', $profile->telepon ?? '') }}" />
                    <x-error-message for="telepon" />
                </div>

                <!-- Alamat -->
                <div>
                    <x-label for="alamat">Alamat</x-label>
                    <textarea name="alamat" id="alamat" rows="3" class="w-full border-gray-300 rounded">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                    <x-error-message for="alamat" />
                </div>

                <!-- Instagram -->
                <div>
                    <x-label for="instagram">Instagram</x-label>
                    <x-text-input name="instagram" id="instagram" class="w-full"
                        value="{{ old('instagram', $profile->instagram ?? '') }}" />
                    <x-error-message for="instagram" />
                </div>

                <!-- Tiktok -->
                <div>
                    <x-label for="tiktok">Tiktok</x-label>
                    <x-text-input name="tiktok" id="tiktok" class="w-full"
                        value="{{ old('tiktok', $profile->tiktok ?? '') }}" />
                    <x-error-message for="tiktok" />
                </div>

                <!-- Web -->
                <div>
                    <x-label for="web">Website</x-label>
                    <x-text-input name="web" id="web" class="w-full"
                        value="{{ old('web', $profile->web ?? '') }}" />
                    <x-error-message for="web" />
                </div>

                <div>
                    <x-btn-primary type="submit">Simpan</x-btn-primary>
                </div>
            </form>
        @elseif($profile)
            <form action="{{ route('profil-kkn.update', $profile->id) }}" method="POST" class="p-6 space-y-4"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Logo -->
                <div>
                    <x-label for="logo">Logo KKN</x-label>
                    <x-text-input type="file" name="logo" id="logo" accept="image/*" class="w-full"
                        onchange="previewLogo(event)" />
                    <x-error-message for="logo" />

                    <!-- Preview Gambar -->
                    <div class="mt-2">
                        <img id="logo-preview" src="{{ $profile->logo ? asset('storage/' . $profile->logo) : '' }}"
                            alt="Preview Logo" class="h-32 rounded border border-gray-300" />
                    </div>
                </div>

                <!-- Script untuk preview -->
                <script>
                    function previewLogo(event) {
                        const input = event.target;
                        const preview = document.getElementById('logo-preview');

                        if (input.files && input.files[0]) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                preview.src = e.target.result;
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

                <!-- Nama Kelompok -->
                <div>
                    <x-label for="nama_kelompok" required>Nama Kelompok</x-label>
                    <x-text-input name="nama_kelompok" id="nama_kelompok" class="w-full"
                        value="{{ old('nama_kelompok', $profile->nama_kelompok ?? '') }}" />
                    <x-error-message for="nama_kelompok" />
                </div>

                <!-- Nama Desa -->
                <div>
                    <x-label for="nama_desa">Nama Desa</x-label>
                    <x-text-input name="nama_desa" id="nama_desa" class="w-full"
                        value="{{ old('nama_desa', $profile->nama_desa ?? '') }}" />
                    <x-error-message for="nama_desa" />
                </div>

                <!-- Pembimbing -->
                <div>
                    <x-label for="pembimbing_id">Pembimbing</x-label>
                    <x-select-input name="pembimbing_id" id="pembimbing_id" class="w-full">
                        <option value="">-- Pilih Pembimbing --</option>
                        @foreach ($pembimbing as $item)
                            <option value="{{ $item->id }}" @selected(old('pembimbing_id', $profile->pembimbing_id ?? '') == $item->id)>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </x-select-input>
                    <x-error-message for="pembimbing_id" />
                </div>

                <!-- Email -->
                <div>
                    <x-label for="email">Email</x-label>
                    <x-text-input name="email" id="email" type="email" class="w-full"
                        value="{{ old('email', $profile->email ?? '') }}" />
                    <x-error-message for="email" />
                </div>

                <!-- Telepon -->
                <div>
                    <x-label for="telepon">No. Telepon</x-label>
                    <x-text-input name="telepon" id="telepon" class="w-full"
                        value="{{ old('telepon', $profile->telepon ?? '') }}" />
                    <x-error-message for="telepon" />
                </div>

                <!-- Alamat -->
                <div>
                    <x-label for="alamat">Alamat</x-label>
                    <textarea name="alamat" id="alamat" rows="3" class="w-full border-gray-300 rounded">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                    <x-error-message for="alamat" />
                </div>

                <!-- Instagram -->
                <div>
                    <x-label for="instagram">Instagram</x-label>
                    <x-text-input name="instagram" id="instagram" class="w-full"
                        value="{{ old('instagram', $profile->instagram ?? '') }}" />
                    <x-error-message for="instagram" />
                </div>

                <!-- Tiktok -->
                <div>
                    <x-label for="tiktok">Tiktok</x-label>
                    <x-text-input name="tiktok" id="tiktok" class="w-full"
                        value="{{ old('tiktok', $profile->tiktok ?? '') }}" />
                    <x-error-message for="tiktok" />
                </div>

                <!-- Web -->
                <div>
                    <x-label for="web">Website</x-label>
                    <x-text-input name="web" id="web" class="w-full"
                        value="{{ old('web', $profile->web ?? '') }}" />
                    <x-error-message for="web" />
                </div>

                <div>
                    <x-btn-warning type="submit">Simpan Perubahan</x-btn-warning>
                </div>
            </form>
        @endif
    </div>

    <!-- Card: Struktur Organisasi -->
    <div class="my-6 bg-white border border-gray-200 rounded-lg shadow-sm p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Struktur Organisasi</h2>

        <form action="{{ route('struktur-organisasi.store') }}" method="POST">
            @csrf
            <input type="hidden" value="{{ $profile->id }}" name="profil_kkn_id">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <!-- Select User -->
                <div>
                    <x-label for="user_id">Anggota</x-label>
                    <select id="user_id" class="w-full border-gray-300 rounded" name="user_id">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Select Jabatan -->
                <div>
                    <x-label for="jabatan_id">Jabatan</x-label>
                    <select id="jabatan_id" class="w-full border-gray-300 rounded" name="jabatan_id">
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Urutan -->
                <div>
                    <x-label for="urutan">Urutan</x-label>
                    <x-text-input type="number" id="urutan" name="urutan" class="w-full" />
                    @error('urutan')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Tombol Tambah -->
                <div class="flex items-end justify-end">
                    <x-btn-primary class="">Tambah ke Daftar</x-btn-primary>
                </div>
            </div>

        </form>

        <!-- Tabel Struktur -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Jabatan</th>
                        <th class="border px-4 py-2">Urutan</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($strukturOrganisasi as $struktur)
                        <tr class="text-sm text-gray-800">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $struktur->user->name }}</td>
                            <td class="border px-4 py-2">{{ $struktur->jabatan->nama_jabatan }}</td>
                            <td class="border px-4 py-2">{{ $struktur->urutan }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('struktur-organisasi.destroy', $struktur->id) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus struktur organisasi ini?')"
                                        class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
