<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-admin-alt text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Setting Jabatan</h2>
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
        <!-- Header with controls -->
        <div class="p-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 overflow-x-auto overflow-y-hidden whitespace-nowrap">
                <div class="flex items-center gap-2 min-w-max">
                    <form action="{{ route('jabatan.index') }}" method="GET" class="flex items-center gap-2">
                        <!-- Select per page -->
                        <div>
                            <x-select-input name="per_page" id="per_page" onchange="this.form.submit()">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </x-select-input>
                        </div>

                        <!-- Search input using Laravel Breeze component -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <x-text-input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari..." class="pl-10 w-60" />
                        </div>

                        <!-- Submit button -->
                        <x-btn-primary type="submit" class="md:hidden">
                            <i class="fi fi-rs-search relative top-0.5"></i>
                        </x-btn-primary>
                    </form>

                </div>

                <!-- Button Add User -->
                <div class="flex gap-2 min-w-max">
                    <button data-modal-target="addModal"
                        class="flex items-center py-2.5 px-2 md:py-2 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors duration-300 rounded-md">
                        <i class="fi fi-rs-plus md:mr-2 leading-none relative top-0.5"></i>
                        <span class="hidden md:block">Tambah Jabatan</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Button Add Jabatan-->
        <div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-60"></div>

            <div class="flex items-center justify-center min-h-screen p-4">
                <div id="modalContent"
                    class="relative bg-white rounded-lg shadow-xl w-full max-w-md md:max-w-xl lg:max-w-2xl mx-auto transition-all duration-300 transform">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900"> <i
                                class="fi fi-rs-plus text-sm mr-2"></i>Tambah
                            Jabatan</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none"
                            data-modal-hide="addModal">
                            <i class="fi fi-rs-cross-small text-xl"></i>
                        </button>
                    </div>

                    <!-- Modal Body with Form -->
                    <form action="{{ route('jabatan.store') }}" method="POST">
                        @csrf
                        <div class="p-4 space-y-4">
                            <!-- Nama -->
                            <div>
                                <x-label for="nama_jabatan" required>Nama Jabatan</x-label>
                                <x-text-input class="w-full" id="nama_jabatan" name="nama_jabatan" type="text"
                                    placeholder="Masukkan nama jabatan" value="{{ old('nama_jabatan') }}" />
                                <x-error-message for="nama_jabatan" />
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="p-4 border-t flex justify-end space-x-3">
                            <x-btn-secondary type="button" data-modal-hide="addModal">
                                Batal
                            </x-btn-secondary>

                            <x-btn-primary type="submit">
                                Simpan
                            </x-btn-primary>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table container -->
        <div class="p-4">
            <div class="overflow-x-auto rounded-md">
                <table class="min-w-full text-left text-gray-500">
                    <thead class="bg-gray-100 text-sm text-gray-700 uppercase">
                        <tr>
                            {{-- <th scope="col" class="px-2 pl-4 py-3 w-10"> <!-- Reduced padding and fixed width -->
                                <input type="checkbox"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </th> --}}
                            <th scope="col" class="px-2 py-3 w-12 text-center">No.</th>
                            <th scope="col" class="p-3">Nama Jabatan</th>
                            <th scope="col" class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jabatan as $data)
                            <tr class="bg-white text-gray-900 border-b hover:bg-gray-100">
                                {{-- <td class="px-2 pl-4 py-3">
                                    <input type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </td> --}}
                                <td class="px-2 py-3 text-center">{{ ++$i }}</td>
                                <td class="p-3 ">{{ $data->nama_jabatan }}</td>
                                <td class="p-3">
                                    <div class="flex items-center gap-2">
                                        <x-btn-warning data-modal-target="editModal{{ $data->id }}"><i
                                                class="fi fi-rs-pencil leading-none relative top-0.5"></i></x-btn-warning>
                                        <x-btn-danger data-modal-target="deleteModal{{ $data->id }}"><i
                                                class="fi fi-rs-trash leading-none relative top-0.5"></i></x-btn-danger>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Jabatan-->
                            <div id="editModal{{ $data->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                <!-- Backdrop -->
                                <div class="fixed inset-0 bg-black bg-opacity-60"></div>

                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <div id="modalContent"
                                        class="relative bg-white rounded-lg shadow-xl w-full max-w-md md:max-w-xl lg:max-w-2xl mx-auto transition-all duration-300 transform">
                                        <!-- Modal Header -->
                                        <div class="flex justify-between items-center p-4 border-b">
                                            <h3 class="text-xl font-semibold text-gray-900"> <i
                                                    class="fi fi-rs-pencil text-sm mr-2"></i>Edit
                                                Jabatan</h3>
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                data-modal-hide="editModal{{ $data->id }}">
                                                <i class="fi fi-rs-cross-small text-xl"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Body with Form -->
                                        <form action="{{ route('jabatan.update', $data->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="p-4 space-y-4">
                                                <!-- Nama -->
                                                <div>
                                                    <x-label for="nama_jabatan" required>Nama Jabatan</x-label>
                                                    <x-text-input class="w-full" id="nama_jabatan"
                                                        name="nama_jabatan" type="text"
                                                        placeholder="Masukkan nama lengkap"
                                                        value="{{ old('nama_jabatan', $data->nama_jabatan) }}" />
                                                    <x-error-message for="nama_jabatan" />
                                                </div>

                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="p-4 border-t flex justify-end space-x-3">
                                                <x-btn-secondary type="button"
                                                    data-modal-hide="editModal{{ $data->id }}">
                                                    Batal
                                                </x-btn-secondary>

                                                <x-btn-primary type="submit">
                                                    Simpan
                                                </x-btn-primary>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Delete Jabatan-->
                            <div id="deleteModal{{ $data->id }}"
                                class="fixed inset-0 z-50 hidden overflow-y-auto">
                                <!-- Backdrop -->
                                <div class="fixed inset-0 bg-black bg-opacity-60"></div>

                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <div id="modalContent"
                                        class="relative bg-white rounded-lg shadow-xl w-full max-w-sm md:max-w-md lg:max-w-md mx-auto transition-all duration-300 transform">
                                        <!-- Modal Header -->
                                        <div class="flex justify-between items-center p-4 border-b">
                                            <h3 class="text-lg font-semibold text-gray-900"> <i
                                                    class="fi fi-rs-trash text-sm mr-2"></i>Delete
                                                Jabatan "{{ $data->nama_jabatan }}"</h3>
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                data-modal-hide="deleteModal{{ $data->id }}">
                                                <i class="fi fi-rs-cross-small text-xl"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Body with Form -->
                                        <form action="{{ route('jabatan.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="p-4 space-y-4">
                                                <p class="text-center text-gray-900">
                                                    Apakah anda yakin ingin menghapus jabatan ini?
                                                </p>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="p-4 border-t flex justify-end space-x-3">
                                                <x-btn-secondary type="button"
                                                    data-modal-hide="deleteModal{{ $data->id }}">
                                                    Batal
                                                </x-btn-secondary>

                                                <x-btn-danger type="submit">
                                                    Hapus
                                                </x-btn-danger>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-5">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination would go here -->
        <div class="p-4 border-t border-gray-200">
            {{ $jabatan->links() }}
        </div>
    </div>

</x-app-layout>
