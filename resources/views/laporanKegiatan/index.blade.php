<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-book-bookmark text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Laporan Kegiatan</h2>
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
            <div class="flex items-end justify-between gap-4 overflow-x-auto overflow-y-hidden whitespace-nowrap">

                <form action="{{ route('laporan-kegiatan.index') }}" method="GET" class="flex items-center gap-2">
                    <div class="flex items-end gap-2">
                        {{-- Input range date --}}
                        <div>
                            <x-label for="startDate">Dari tanggal</x-label>
                            <x-text-input class="w-full" id="startDate" name="startDate" type="date"
                                value="{{ request('startDate') }}" />
                        </div>
                        <div>
                            <x-label for="endDate">Sampai tanggal</x-label>
                            <x-text-input class="w-full" id="endDate" name="endDate" type="date"
                                value="{{ request('endDate') }}" />
                        </div>
                        {{-- Select Operator --}}
                        {{-- <div>
                            <x-label for="id_users">Operator</x-label>
                            <x-select-input name="id_users" id="id_users">
                                <option value="" selected hidden>-- Pilih Operator --</option>
                                @foreach ($dataOperator as $operator)
                                    <option value="{{ $operator->id }}"
                                        {{ request('id_users') == $operator->id ? 'selected' : '' }}>
                                        {{ $operator->nama_user }}</option>
                                @endforeach
                            </x-select-input>
                        </div> --}}
                        {{-- Proker --}}
                        <div>
                            <x-label for="proker_id">Proker</x-label>
                            <x-select-input name="proker_id" id="proker_id">
                                <option value="" selected hidden>-- Pilih Proker --</option>
                                @foreach ($proker as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('proker_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_proker }}
                                    </option>
                                @endforeach
                            </x-select-input>
                        </div>
                        <x-btn-primary type="submit"
                            class="flex items-center py-2.5 px-2 md:py-2 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors duration-300 rounded-md">
                            {{-- <i class="fi fi-rs-menu-dots-vertical leading-none relative top-0.5"></i> --}}
                            Proses
                        </x-btn-primary>
                        <a href="{{ route('laporan-kegiatan.index') }}">
                            <x-btn-warning type="button"
                                class="flex items-center py-2.5 px-2 md:py-2 border border-yellow-600 text-yellow-600 hover:bg-yellow-600 hover:text-white transition-colors duration-300 rounded-md">
                                {{-- <i class="fi fi-rs-menu-dots-vertical leading-none relative top-0.5"></i> --}}
                                <span class="text-white">Reset</span>
                            </x-btn-warning>
                        </a>
                    </div>


                </form>

                <div class="flex items-end gap-2">
                    <a href="{{ route('laporan-kegiatan.xls', ['startDate' => request()->startDate, 'endDate' => request()->endDate, 'proker_id' => request()->proker_id]) }}"
                        class="flex items-center py-2.5 px-2 md:py-2 border border-green-600 text-green-600 hover:bg-green-600 hover:text-white transition-colors duration-300 rounded-md">
                        Export Excel
                    </a>
                    <a href="{{ route('laporan-kegiatan.pdf', ['startDate' => request()->startDate, 'endDate' => request()->endDate, 'proker_id' => request()->proker_id]) }}"
                        class="flex items-center py-2.5 px-2 md:py-2 border border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition-colors duration-300 rounded-md">
                        Export PDF
                    </a>
                </div>

            </div>
        </div>

        <!-- Modal Tambah Proker-->
        {{-- <div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-60"></div>

            <div class="flex items-center justify-center min-h-screen p-4">
                <div id="modalContent"
                    class="relative bg-white rounded-lg shadow-xl w-full max-w-md md:max-w-xl lg:max-w-2xl mx-auto transition-all duration-300 transform">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900"> <i class="fi fi-rs-plus text-sm mr-2"></i>Input
                            Kegiatan</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none"
                            data-modal-hide="addModal">
                            <i class="fi fi-rs-cross-small text-xl"></i>
                        </button>
                    </div>

                    <!-- Modal Body with Form -->
                    <form action="{{ route('kegiatan.store') }}" method="POST">
                        @csrf
                        <div class="p-4 space-y-4">

                            <!-- proker -->
                            <div>
                                <x-label for="proker_id">Proker</x-label>
                                <x-select-input id="proker_id" class="w-full" name="proker_id">
                                    <option selected disabled>-- Pilih Proker Terkait --</option>
                                    @foreach ($proker as $proker1)
                                        <option value="{{ $proker1->id }}"
                                            {{ old('proker_id') == $proker1->id ? 'selected' : '' }}>
                                            {{ $proker1->nama_proker }}
                                        </option>
                                    @endforeach
                                </x-select-input>
                                <x-error-message for="proker_id" />
                            </div>

                            <!-- nama_kegiatan -->
                            <div>
                                <x-label for="nama_kegiatan" required>Nama Kegiatan</x-label>
                                <x-text-input class="w-full" id="nama_kegiatan" name="nama_kegiatan" type="text"
                                    placeholder="Nama Kegiatan..." value="{{ old('nama_kegiatan') }}" />
                                <x-error-message for="nama_kegiatan" />
                            </div>
                            <div class="flex flex-wrap gap-4 w-full">
                                <!-- Tanggal Kegiatan (full width on all screens) -->
                                <div class="flex-1 min-w-0">
                                    <x-label for="tgl_kegiatan" required>Tanggal Kegiatan</x-label>
                                    <x-text-input class="w-full" id="tgl_kegiatan" name="tgl_kegiatan" type="date"
                                        placeholder="Tanggal Kegiatan..." value="{{ old('tgl_kegiatan') }}" />
                                    <x-error-message for="tgl_kegiatan" />
                                </div>

                                <!-- Waktu Mulai -->
                                <div class="sm:w-30">
                                    <x-label for="waktu_mulai">Waktu Mulai</x-label>
                                    <x-text-input class="w-full" id="waktu_mulai" name="waktu_mulai" type="time"
                                        placeholder="Waktu Mulai Kegiatan..." value="{{ old('waktu_mulai') }}" />
                                    <x-error-message for="waktu_mulai" />
                                </div>

                                <!-- Waktu Selesai -->
                                <div class="sm:w-30">
                                    <x-label for="waktu_selesai">Waktu Selesai</x-label>
                                    <x-text-input class="w-full" id="waktu_selesai" name="waktu_selesai" type="time"
                                        placeholder="Waktu Selesai Kegiatan..." value="{{ old('waktu_selesai') }}" />
                                    <x-error-message for="waktu_selesai" />
                                </div>
                            </div>


                            <!-- lokasi_kegiatan -->
                            <div>
                                <x-label for="lokasi_kegiatan" required>Lokasi Kegiatan</x-label>
                                <x-text-input class="w-full" id="lokasi_kegiatan" name="lokasi_kegiatan"
                                    type="text" placeholder="Lokasi Kegiatan..."
                                    value="{{ old('lokasi_kegiatan') }}" />
                                <x-error-message for="lokasi_kegiatan" />
                            </div>

                            <!-- deskripsi_kegiatan -->
                            <div>
                                <x-label for="deskripsi_kegiatan" required>Deskripsi Kegiatan</x-label>
                                <x-text-input class="w-full" id="deskripsi_kegiatan" name="deskripsi_kegiatan"
                                    type="text" placeholder="Deskripsi Kegiatan..."
                                    value="{{ old('deskripsi_kegiatan') }}" />
                                <x-error-message for="deskripsi_kegiatan" />
                            </div>

                            <!-- hasil_kegiatan -->
                            <div>
                                <x-label for="hasil_kegiatan">Hasil Kegiatan</x-label>
                                <x-text-input class="w-full" id="hasil_kegiatan" name="hasil_kegiatan"
                                    type="text" placeholder="Hasil Kegiatan..."
                                    value="{{ old('hasil_kegiatan') }}" />
                                <x-error-message for="hasil_kegiatan" />
                            </div>

                            <!-- kendala_kegiatan -->
                            <div>
                                <x-label for="kendala_kegiatan">Kendala Kegiatan</x-label>
                                <x-text-input class="w-full" id="kendala_kegiatan" name="kendala_kegiatan"
                                    type="text" placeholder="Kendala Kegiatan..."
                                    value="{{ old('kendala_kegiatan') }}" />
                                <x-error-message for="kendala_kegiatan" />
                            </div>

                            <!-- jenis_laporan -->
                            <div>
                                <x-label for="jenis_laporan_kegiatan" required>Jenis Kegiatan</x-label>
                                <x-select-input id="jenis_laporan_kegiatan" class="w-full"
                                    name="jenis_laporan_kegiatan">
                                    <option selected disabled>-- Pilih jenis kegiatan --</option>
                                    <option value="harian"
                                        {{ old('jenis_laporan_kegiatan') == 'harian' ? 'selected' : '' }}>
                                        Harian
                                    </option>
                                    <option value="mingguan"
                                        {{ old('jenis_laporan_kegiatan') == 'mingguan' ? 'selected' : '' }}>
                                        Mingguan
                                    </option>
                                </x-select-input>
                                <x-error-message for="jenis_laporan_kegiatan" />
                            </div>

                            <!-- link_dokumentasi -->
                            <div>
                                <x-label for="link_dokumentasi_kegiatan">Link Dokumentasi</x-label>
                                <x-text-input class="w-full" id="link_dokumentasi_kegiatan"
                                    name="link_dokumentasi_kegiatan" type="text" placeholder="Link Dokumentasi..."
                                    value="{{ old('link_dokumentasi_kegiatan') }}" />
                                <x-error-message for="link_dokumentasi_kegiatan" />
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
        </div> --}}

        <!-- Table container -->
        <div class="p-4">
            <div class="overflow-x-auto rounded-md">
                <table class="min-w-full text-left text-gray-500">
                    <thead class="bg-gray-100 text-sm text-gray-700 uppercase">
                        <tr class="border-b">
                            {{-- <th scope="col" class="px-2 pl-4 py-3 w-10"> <!-- Reduced padding and fixed width -->
                                <input type="checkbox"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </th> --}}
                            <th scope="col" class="px-2 py-3 w-12 text-center">No.</th>
                            <th scope="col" class="p-3">Nama Kegiatan</th>
                            <th scope="col" class="p-3">Tgl. Kegiatan</th>
                            <th scope="col" class="p-3">Lokasi</th>
                            {{-- <th scope="col" class="p-3">Waktu</th> --}}
                            <th scope="col" class="p-3">Deskripsi</th>
                            {{-- <th scope="col" class="p-3">Hasil Kegiatan</th>
                            <th scope="col" class="p-3">Kendala</th> --}}
                            {{-- <th scope="col" class="p-3">Jenis Laporan</th> --}}
                            {{-- <th scope="col" class="p-3">Link Dokumentasi</th> --}}
                            <th scope="col" class="p-3">Dibuat Oleh</th>
                            {{-- <th scope="col" class="p-3">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kegiatan as $data)
                            <tr class="bg-white text-gray-900 border-b hover:bg-gray-100">
                                {{-- <td class="px-2 pl-4 py-3">
                                    <input type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </td> --}}
                                <td class="px-2 py-3 text-center">{{ $loop->iteration }}</td>
                                <td class="p-3 ">{{ $data->nama_kegiatan }}</td>
                                <td class="p-3">
                                    {{ optional($data->tgl_kegiatan ? Carbon\Carbon::parse($data->tgl_kegiatan) : null)->translatedFormat('l, d F Y') ?? '-' }}
                                </td>
                                <td class="p-3">{{ $data->lokasi_kegiatan }}</td>
                                <td class="p-3">{{ $data->deskripsi_kegiatan ?? '-' }}</td>
                                <td class="p-3">{{ $data->creator->name ?? '-' }}
                                </td>
                                {{-- <td class="p-3">
                                    <div class="flex items-center gap-2">
                                        <x-btn-primary data-modal-target="editModal{{ $data->id }}"><i
                                                class="fi fi-rs-eye leading-none relative top-0.5"></i></x-btn-primary>
                                    </div>
                                </td> --}}
                            </tr>

                            <!-- Modal Edit User-->
                            {{-- <div id="editModal{{ $data->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                <!-- Backdrop -->
                                <div class="fixed inset-0 bg-black bg-opacity-60"></div>

                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <div id="modalContent"
                                        class="relative bg-white rounded-lg shadow-xl w-full max-w-md md:max-w-xl lg:max-w-2xl mx-auto transition-all duration-300 transform">
                                        <!-- Modal Header -->
                                        <div class="flex justify-between items-center p-4 border-b">
                                            <h3 class="text-xl font-semibold text-gray-900"> <i
                                                    class="fi fi-rs-pencil text-sm mr-2"></i>Edit
                                                Kegiatan</h3>
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                data-modal-hide="editModal{{ $data->id }}">
                                                <i class="fi fi-rs-cross-small text-xl"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Body with Form -->
                                        <form action="{{ route('kegiatan.update', $data->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="p-4 space-y-4">

                                                <!-- proker -->
                                                <div>
                                                    <x-label for="proker_id">Proker</x-label>
                                                    <x-select-input id="proker_id" class="w-full" name="proker_id">
                                                        <option selected disabled>-- Pilih Proker Terkait --</option>
                                                        @foreach ($proker as $proker1)
                                                            <option value="{{ $proker1->id }}"
                                                                {{ old('proker_id') == $proker1->id || $data->proker_id == $proker1->id ? 'selected' : '' }}>
                                                                {{ $proker1->nama_proker }}
                                                            </option>
                                                        @endforeach
                                                        <option value="">Hapus Proker Terkait</option>
                                                    </x-select-input>
                                                    <x-error-message for="proker_id" />
                                                </div>

                                                <!-- nama_kegiatan -->
                                                <div>
                                                    <x-label for="nama_kegiatan" required>Nama Kegiatan</x-label>
                                                    <x-text-input class="w-full" id="nama_kegiatan"
                                                        name="nama_kegiatan" type="text"
                                                        placeholder="Nama Kegiatan..."
                                                        value="{{ old('nama_kegiatan', $data->nama_kegiatan) }}" />
                                                    <x-error-message for="nama_kegiatan" />
                                                </div>
                                                <div class="flex flex-wrap gap-4 w-full">
                                                    <!-- Tanggal Kegiatan (full width on all screens) -->
                                                    <div class="flex-1 min-w-0">
                                                        <x-label for="tgl_kegiatan" required>Tanggal Kegiatan</x-label>
                                                        <x-text-input class="w-full" id="tgl_kegiatan"
                                                            name="tgl_kegiatan" type="date"
                                                            placeholder="Tanggal Kegiatan..."
                                                            value="{{ old('tgl_kegiatan', $data->tgl_kegiatan) }}" />
                                                        <x-error-message for="tgl_kegiatan" />
                                                    </div>

                                                    <!-- Waktu Mulai -->
                                                    <div class="sm:w-30">
                                                        <x-label for="waktu_mulai">Waktu Mulai</x-label>
                                                        <x-text-input class="w-full" id="waktu_mulai"
                                                            name="waktu_mulai" type="time"
                                                            placeholder="Waktu Mulai Kegiatan..."
                                                            value="{{ old('waktu_mulai', $data->waktu_mulai ? \Carbon\Carbon::parse($data->waktu_mulai)->format('H:i') : '') }}" />
                                                        <x-error-message for="waktu_mulai" />
                                                    </div>

                                                    <!-- Waktu Selesai -->
                                                    <div class="sm:w-30">
                                                        <x-label for="waktu_selesai">Waktu Selesai</x-label>
                                                        <x-text-input class="w-full" id="waktu_selesai"
                                                            name="waktu_selesai" type="time"
                                                            placeholder="Waktu Selesai Kegiatan..."
                                                            value="{{ old('waktu_mulai', $data->waktu_selesai ? \Carbon\Carbon::parse($data->waktu_selesai)->format('H:i') : '') }}" />
                                                        <x-error-message for="waktu_selesai" />
                                                    </div>
                                                </div>

                                                <!-- lokasi_kegiatan -->
                                                <div>
                                                    <x-label for="lokasi_kegiatan" required>Lokasi Kegiatan</x-label>
                                                    <x-text-input class="w-full" id="lokasi_kegiatan"
                                                        name="lokasi_kegiatan" type="text"
                                                        placeholder="Lokasi Kegiatan..."
                                                        value="{{ old('lokasi_kegiatan', $data->lokasi_kegiatan) }}" />
                                                    <x-error-message for="lokasi_kegiatan" />
                                                </div>

                                                <!-- deskripsi_kegiatan -->
                                                <div>
                                                    <x-label for="deskripsi_kegiatan" required>Deskripsi
                                                        Kegiatan</x-label>
                                                    <x-text-input class="w-full" id="deskripsi_kegiatan"
                                                        name="deskripsi_kegiatan" type="text"
                                                        placeholder="Deskripsi Kegiatan..."
                                                        value="{{ old('deskripsi_kegiatan', $data->deskripsi_kegiatan) }}" />
                                                    <x-error-message for="deskripsi_kegiatan" />
                                                </div>

                                                <!-- hasil_kegiatan -->
                                                <div>
                                                    <x-label for="hasil_kegiatan">Hasil Kegiatan</x-label>
                                                    <x-text-input class="w-full" id="hasil_kegiatan"
                                                        name="hasil_kegiatan" type="text"
                                                        placeholder="Hasil Kegiatan..."
                                                        value="{{ old('hasil_kegiatan', $data->hasil_kegiatan) }}" />
                                                    <x-error-message for="hasil_kegiatan" />
                                                </div>

                                                <!-- kendala_kegiatan -->
                                                <div>
                                                    <x-label for="kendala_kegiatan">Kendala Kegiatan</x-label>
                                                    <x-text-input class="w-full" id="kendala_kegiatan"
                                                        name="kendala_kegiatan" type="text"
                                                        placeholder="Kendala Kegiatan..."
                                                        value="{{ old('kendala_kegiatan', $data->kendala_kegiatan) }}" />
                                                    <x-error-message for="kendala_kegiatan" />
                                                </div>

                                                <!-- jenis_laporan -->
                                                <div>
                                                    <x-label for="jenis_laporan_kegiatan" required>Jenis
                                                        Kegiatan</x-label>
                                                    <x-select-input id="jenis_laporan_kegiatan" class="w-full"
                                                        name="jenis_laporan_kegiatan">
                                                        <option selected disabled>-- Pilih jenis kegiatan --</option>
                                                        <option value="harian"
                                                            {{ old('jenis_laporan_kegiatan') == 'harian' || $data->jenis_laporan_kegiatan == 'harian' ? 'selected' : '' }}>
                                                            Harian
                                                        </option>
                                                        <option value="mingguan"
                                                            {{ old('jenis_laporan_kegiatan') == 'mingguan' || $data->jenis_laporan_kegiatan == 'mingguan' ? 'selected' : '' }}>
                                                            Mingguan
                                                        </option>
                                                    </x-select-input>
                                                    <x-error-message for="jenis_laporan_kegiatan" />
                                                </div>

                                                <!-- link_dokumentasi -->
                                                <div>
                                                    <x-label for="link_dokumentasi_kegiatan">Link Dokumentasi</x-label>
                                                    <x-text-input class="w-full" id="link_dokumentasi_kegiatan"
                                                        name="link_dokumentasi_kegiatan" type="text"
                                                        placeholder="Link Dokumentasi..."
                                                        value="{{ old('link_dokumentasi_kegiatan', $data->link_dokumentasi_kegiatan) }}" />
                                                    <x-error-message for="link_dokumentasi_kegiatan" />
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
                            </div> --}}

                            <!-- Modal Delete User-->
                            {{-- <div id="deleteModal{{ $data->id }}"
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
                                                Kegiatan "{{ $data->nama_kegiatan }}"</h3>
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                data-modal-hide="deleteModal{{ $data->id }}">
                                                <i class="fi fi-rs-cross-small text-xl"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Body with Form -->
                                        <form action="{{ route('kegiatan.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="p-4 space-y-4">
                                                <p class="text-center text-gray-900">
                                                    Apakah anda yakin ingin menghapus kegiatan
                                                    '{{ $data->nama_kegiatan }}'
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
                            </div> --}}
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-5">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination would go here -->
        {{-- <div class="p-4 border-t border-gray-200">
            {{ $kegiatan->links() }}
        </div> --}}
    </div>

</x-app-layout>
