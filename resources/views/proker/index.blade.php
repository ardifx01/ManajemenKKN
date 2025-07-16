<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-list text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Program Kerja</h2>
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

                <div class="flex items-center gap-2">
                    <form action="{{ route('proker.index') }}" method="GET" class="flex items-center gap-2">
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

                <!-- Button Tambah Proker -->
                <div class="flex gap-2">
                    <button data-modal-target="addModal"
                        class="flex items-center py-2.5 px-2 md:py-2 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors duration-300 rounded-md">
                        <i class="fi fi-rs-plus md:mr-2 leading-none relative top-0.5"></i>
                        <span class="hidden md:block">
                            Tambah Proker
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Proker-->
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
                            Proker</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none"
                            data-modal-hide="addModal">
                            <i class="fi fi-rs-cross-small text-xl"></i>
                        </button>
                    </div>

                    <!-- Modal Body with Form -->
                    <form action="{{ route('proker.store') }}" method="POST">
                        @csrf
                        <div class="p-4 space-y-4">
                            <!-- Nama -->
                            <div>
                                <x-label for="nama_proker" required>Nama Proker</x-label>
                                <x-text-input class="w-full" id="nama_proker" name="nama_proker" type="text"
                                    placeholder="Nama Proker..." value="{{ old('nama_proker') }}" />
                                <x-error-message for="nama_proker" />
                            </div>

                            <!-- jenis_proker -->
                            <div>
                                <x-label for="jenis_proker" required>Jenis Proker</x-label>
                                <x-select-input id="jenis_proker" class="w-full" name="jenis_proker">
                                    <option selected disabled>-- Pilih jenis proker --</option>
                                    <option value="internal" {{ old('jenis_proker') == 'internal' ? 'selected' : '' }}>
                                        Internal
                                    </option>
                                    <option value="eksternal"
                                        {{ old('jenis_proker') == 'eksternal' ? 'selected' : '' }}>
                                        Eksternal
                                    </option>
                                </x-select-input>
                                <x-error-message for="jenis_proker" />
                            </div>

                            <!-- sasaran -->
                            <div>
                                <x-label for="sasaran" required>Sasaran</x-label>
                                <x-text-input class="w-full" id="sasaran" name="sasaran" type="text"
                                    placeholder="Sasaran Kegiatan..." value="{{ old('sasaran') }}" />
                                <x-error-message for="sasaran" />
                            </div>

                            <!-- deskripsi -->
                            <div>
                                <x-label for="deskripsi" required>Deskripsi</x-label>
                                <x-text-input class="w-full" id="deskripsi" name="deskripsi" type="text"
                                    placeholder="Deskripsi Kegiatan..." value="{{ old('deskripsi') }}" />
                                <x-error-message for="deskripsi" />
                            </div>
                            <!-- tgl_mulai -->
                            <div>
                                <x-label for="tgl_mulai">Tanggal Mulai</x-label>
                                <x-text-input class="w-full" id="tgl_mulai" name="tgl_mulai" type="date"
                                    placeholder="Tanggal Mulai Kegiatan..." value="{{ old('tgl_mulai') }}" />
                                <x-error-message for="tgl_mulai" />
                            </div>
                            <!-- tgl_selesai -->
                            <div>
                                <x-label for="tgl_selesai">Tanggal Selesai</x-label>
                                <x-text-input class="w-full" id="tgl_selesai" name="tgl_selesai" type="date"
                                    placeholder="Tanggal Mulai Kegiatan..." value="{{ old('tgl_selesai') }}" />
                                <x-error-message for="tgl_selesai" />
                            </div>

                            <!-- status -->
                            <div>
                                <x-label for="status" required>Status Proker</x-label>
                                <x-select-input id="status" class="w-full" name="status">
                                    <option selected disabled>-- Pilih jenis proker --</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="berjalan" {{ old('status') == 'berjalan' ? 'selected' : '' }}>
                                        Berjalan
                                    </option>
                                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                </x-select-input>
                                <x-error-message for="status" />
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
                            <th scope="col" class="p-3">Nama Proker</th>
                            <th scope="col" class="p-3">Jenis Proker</th>
                            <th scope="col" class="p-3">Sasaran</th>
                            <th scope="col" class="p-3">Deskripsi</th>
                            <th scope="col" class="p-3">Tgl. Mulai</th>
                            <th scope="col" class="p-3">Tgl. Selesai</th>
                            <th scope="col" class="p-3">Status</th>
                            <th scope="col" class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($proker as $data)
                            <tr class="bg-white text-gray-900 border-b hover:bg-gray-100">
                                {{-- <td class="px-2 pl-4 py-3">
                                    <input type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </td> --}}
                                <td class="px-2 py-3 text-center">{{ ++$i }}</td>
                                <td class="p-3 ">{{ $data->nama_proker }}</td>
                                <td class="p-3">
                                    @if ($data->jenis_proker == 'internal')
                                        <span
                                            class="px-2.5 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($data->jenis_proker) }}</span>
                                    @else
                                        <span
                                            class="px-2.5 py-0.5 text-xs rounded-full bg-blue-100 text-blue-800">{{ ucfirst($data->jenis_proker) }}</span>
                                    @endif
                                </td>
                                <td class="p-3">{{ $data->sasaran }}</td>
                                <td class="p-3">{{ $data->deskripsi }}</td>
                                <td class="p-3">
                                    {{ optional($data->tgl_mulai ? Carbon\Carbon::parse($data->tgl_mulai) : null)->translatedFormat('l, d F Y') ?? '-' }}
                                </td>
                                <td class="p-3">
                                    {{ optional($data->tgl_selesai ? Carbon\Carbon::parse($data->tgl_selesai) : null)->translatedFormat('l, d F Y') ?? '-' }}

                                </td>
                                <td class="p-3">
                                    @if ($data->status == 'pending')
                                        <span
                                            class="px-2.5 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($data->status) }}</span>
                                    @elseif ($data->status == 'berjalan')
                                        <span
                                            class="px-2.5 py-0.5 text-xs rounded-full bg-blue-100 text-blue-800">{{ ucfirst($data->status) }}</span>
                                    @elseif ($data->status == 'selesai')
                                        <span
                                            class="px-2.5 py-0.5 text-xs rounded-full bg-green-100 text-green-800">{{ ucfirst($data->status) }}</span>
                                    @endif
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center gap-2">
                                        <x-btn-warning data-modal-target="editModal{{ $data->id }}"><i
                                                class="fi fi-rs-pencil leading-none relative top-0.5"></i></x-btn-warning>
                                        <x-btn-danger data-modal-target="deleteModal{{ $data->id }}"><i
                                                class="fi fi-rs-trash leading-none relative top-0.5"></i></x-btn-danger>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit User-->
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
                                                Proker</h3>
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                data-modal-hide="editModal{{ $data->id }}">
                                                <i class="fi fi-rs-cross-small text-xl"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Body with Form -->
                                        <form action="{{ route('proker.update', $data->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="p-4 space-y-4">
                                                <!-- Nama -->
                                                <div>
                                                    <x-label for="nama_proker" required>Nama Proker</x-label>
                                                    <x-text-input class="w-full" id="nama_proker" name="nama_proker"
                                                        type="text" placeholder="Nama Proker..."
                                                        value="{{ old('nama_proker', $data->nama_proker) }}" />
                                                    <x-error-message for="nama_proker" />
                                                </div>

                                                <!-- jenis_proker -->
                                                <div>
                                                    <x-label for="jenis_proker" required>Jenis Proker</x-label>
                                                    <x-select-input id="jenis_proker" class="w-full"
                                                        name="jenis_proker">
                                                        <option selected disabled>-- Pilih jenis proker --</option>
                                                        <option value="internal"
                                                            {{ old('jenis_proker') == 'internal' || $data->jenis_proker == 'internal' ? 'selected' : '' }}>
                                                            Internal
                                                        </option>
                                                        <option value="eksternal"
                                                            {{ old('jenis_proker') == 'eksternal' || $data->jenis_proker == 'eksternal' ? 'selected' : '' }}>
                                                            Eksternal
                                                        </option>
                                                    </x-select-input>
                                                    <x-error-message for="jenis_proker" />
                                                </div>

                                                <!-- sasaran -->
                                                <div>
                                                    <x-label for="sasaran" required>Sasaran</x-label>
                                                    <x-text-input class="w-full" id="sasaran" name="sasaran"
                                                        type="text" placeholder="Sasaran Kegiatan..."
                                                        value="{{ old('sasaran', $data->sasaran) }}" />
                                                    <x-error-message for="sasaran" />
                                                </div>

                                                <!-- deskripsi -->
                                                <div>
                                                    <x-label for="deskripsi" required>Deskripsi</x-label>
                                                    <x-text-input class="w-full" id="deskripsi" name="deskripsi"
                                                        type="text" placeholder="Deskripsi Kegiatan..."
                                                        value="{{ old('deskripsi', $data->deskripsi) }}" />
                                                    <x-error-message for="deskripsi" />
                                                </div>
                                                <!-- tgl_mulai -->
                                                <div>
                                                    <x-label for="tgl_mulai">Tanggal Mulai</x-label>
                                                    <x-text-input class="w-full" id="tgl_mulai" name="tgl_mulai"
                                                        type="date" placeholder="Tanggal Mulai Kegiatan..."
                                                        value="{{ $data->tgl_mulai }}" />
                                                    <x-error-message for="tgl_mulai" />
                                                </div>
                                                <!-- tgl_selesai -->
                                                <div>
                                                    <x-label for="tgl_selesai">Tanggal Selesai</x-label>
                                                    <x-text-input class="w-full" id="tgl_selesai" name="tgl_selesai"
                                                        type="date" placeholder="Tanggal Mulai Kegiatan..."
                                                        value="{{ $data->tgl_selesai }}" />
                                                    <x-error-message for="tgl_selesai" />
                                                </div>

                                                <!-- status -->
                                                <div>
                                                    <x-label for="status" required>Status Proker</x-label>
                                                    <x-select-input id="status" class="w-full" name="status">
                                                        <option selected disabled>-- Pilih jenis proker --</option>
                                                        <option value="pending"
                                                            {{ old('status') == 'pending' || $data->status == 'pending' ? 'selected' : '' }}>
                                                            Pending
                                                        </option>
                                                        <option value="berjalan"
                                                            {{ old('status') == 'pending' || $data->status == 'berjalan' ? 'selected' : '' }}>
                                                            Berjalan
                                                        </option>
                                                        <option value="selesai"
                                                            {{ old('status') == 'selesai' || $data->status == 'selesai' ? 'selected' : '' }}>
                                                            Selesai
                                                        </option>
                                                    </x-select-input>
                                                    <x-error-message for="status" />
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

                            <!-- Modal Delete User-->
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
                                                Proker "{{ $data->nama_proker }}"</h3>
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                data-modal-hide="deleteModal{{ $data->id }}">
                                                <i class="fi fi-rs-cross-small text-xl"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Body with Form -->
                                        <form action="{{ route('proker.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="p-4 space-y-4">
                                                <p class="text-center text-gray-900">
                                                    Apakah anda yakin ingin menghapus proker '{{ $data->nama_proker }}'
                                                    ini?
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
                                <td colspan="9" class="text-center p-5">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination would go here -->
        <div class="p-4 border-t border-gray-200">
            {{ $proker->links() }}
        </div>
    </div>

</x-app-layout>
