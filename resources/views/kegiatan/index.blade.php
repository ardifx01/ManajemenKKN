<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-journal-alt text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Input Kegiatan</h2>
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
                    <form action="{{ route('kegiatan.index') }}" method="GET" class="flex items-center gap-2">
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

                        {{-- Filter Data --}}
                        <div>
                            <x-select-input name="filter" id="filter" onchange="this.form.submit()">
                                <option value="" disabled>-- Filter Data --</option>
                                <option value="hari_ini" {{ request('filter') == 'hari_ini' ? 'selected' : '' }}>
                                    Hari ini
                                </option>
                                <option value="saya" {{ request('filter') == 'saya' ? 'selected' : '' }}>
                                    Kegiatan Saya
                                </option>
                                <option value="bukan_saya" {{ request('filter') == 'bukan_saya' ? 'selected' : '' }}>
                                    Bukan Kegiatan Saya
                                </option>
                                <option value="belum" {{ request('filter') == 'belum' ? 'selected' : '' }}>
                                    Belum terkait proker
                                </option>
                                <option value="semua" {{ request('filter') == 'semua' ? 'selected' : '' }}>
                                    Semua
                                </option>
                            </x-select-input>
                        </div>
                    </form>

                </div>

                <!-- Button Tambah Proker -->
                <div class="flex gap-2">
                    <button data-modal-target="addModal"
                        class="flex items-center py-2.5 px-2 md:py-2 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors duration-300 rounded-md">
                        <i class="fi fi-rs-plus md:mr-2 leading-none relative top-0.5"></i>
                        <span class="hidden md:block">
                            Input Kegiatan
                        </span>
                    </button>

                    @if (request('filter') == 'saya')
                        <a href="{{ route('laporan-kegiatan-saya.xls', ['filter' => request()->filter]) }}"
                            class="flex items-center py-2.5 px-2 md:py-2 border border-green-600 text-green-600 hover:bg-green-600 hover:text-white transition-colors duration-300 rounded-md">
                            <i class="fi fi-rs-file-excel md:mr-2 leading-none relative top-0.5"></i>
                            <span class="hidden md:block">
                                Export Excel
                            </span>
                        </a>
                    @endif
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

                            <!-- pemimpin_rapat_id -->
                            @if (Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
                                <div>
                                    <x-label for="pemimpin_rapat_id">Pemimpin Rapat</x-label>
                                    <x-select-input id="pemimpin_rapat_id" class="w-full" name="pemimpin_rapat_id">
                                        <option selected disabled>-- Pilih Pemimpin Rapat --</option>
                                        @foreach ($pemimpin_rapat as $rapat)
                                            <option value="{{ $rapat->id }}"
                                                {{ old('pemimpin_rapat_id') == $rapat->id ? 'selected' : '' }}>
                                                {{ $rapat->name }}
                                            </option>
                                        @endforeach
                                    </x-select-input>
                                    <x-error-message for="pemimpin_rapat_id" />
                                </div>
                            @endif

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
                                    <x-text-input class="w-full" id="waktu_selesai" name="waktu_selesai"
                                        type="time" placeholder="Waktu Selesai Kegiatan..."
                                        value="{{ old('waktu_selesai') }}" />
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
                            {{-- <div>
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
                            </div> --}}

                            <!-- link_dokumentasi foto -->
                            <div>
                                <x-label for="link_dokumentasi_foto">Link Dokumentasi Foto</x-label>
                                <x-text-input class="w-full" id="link_dokumentasi_foto" name="link_dokumentasi_foto"
                                    type="text" placeholder="Link Dokumentasi Foto..."
                                    value="{{ old('link_dokumentasi_foto') }}" />
                                <x-error-message for="link_dokumentasi_foto" />
                            </div>
                            <!-- link_dokumentasi video -->
                            <div>
                                <x-label for="link_dokumentasi_video">Link Dokumentasi Video</x-label>
                                <x-text-input class="w-full" id="link_dokumentasi_video"
                                    name="link_dokumentasi_video" type="text"
                                    placeholder="Link Dokumentasi Video..."
                                    value="{{ old('link_dokumentasi_video') }}" />
                                <x-error-message for="link_dokumentasi_video" />
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
                            <th scope="col" class="p-3">Nama Kegiatan</th>
                            <th scope="col" class="p-3">Tgl. Kegiatan</th>
                            <th scope="col" class="p-3">Lokasi</th>
                            {{-- <th scope="col" class="p-3">Waktu</th>
                            <th scope="col" class="p-3">Deskripsi</th>
                            <th scope="col" class="p-3">Hasil Kegiatan</th>
                            <th scope="col" class="p-3">Kendala</th>  --}}
                            {{-- <th scope="col" class="p-3">Jenis Laporan</th> --}}
                            <th scope="col" class="p-3 text-center">Foto</th>
                            <th scope="col" class="p-3 text-center">Video</th>
                            <th scope="col" class="p-3">Dibuat Oleh</th>
                            <th scope="col" class="p-3 text-center text-blue-500">Absensi</th>
                            @if (Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
                                <th scope="col" class="p-3 text-center text-blue-500">Notulensi</th>
                                <th scope="col" class="p-3 text-center text-blue-500">Berita Acara</th>
                            @endif
                            <th scope="col" class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kegiatan as $data)
                            <tr class="bg-white text-gray-900 border-b hover:bg-gray-100">
                                {{-- <td class="px-2 pl-4 py-3">
                                    <input type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </td> --}}
                                <td class="px-2 py-3 text-center">{{ ++$i }}</td>
                                <td class="p-3 ">{{ $data->nama_kegiatan }}</td>
                                <td class="p-3">
                                    {{ optional($data->tgl_kegiatan ? Carbon\Carbon::parse($data->tgl_kegiatan) : null)->translatedFormat('l, d F Y') ?? '-' }}
                                </td>
                                <td class="p-3">{{ $data->lokasi_kegiatan }}</td>
                                <td class="p-3 text-center">
                                    @if ($data->link_dokumentasi_foto)
                                        <a href="{{ $data->link_dokumentasi_foto }}" target="_blank">
                                            <x-btn-primary><i
                                                    class="fi
                            fi-rs-link leading-none relative top-0.5"></i>
                                            </x-btn-primary>
                                        </a>
                                    @elseif (!$data->link_dokumentasi_foto)
                                        -
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    @if ($data->link_dokumentasi_video)
                                        <a href="{{ $data->link_dokumentasi_video }}" target="_blank">
                                            <x-btn-primary><i
                                                    class="fi
                            fi-rs-link leading-none relative top-0.5"></i>
                                            </x-btn-primary>
                                        </a>
                                    @elseif (!$data->link_dokumentasi_video)
                                        -
                                    @endif
                                </td>
                                <td class="p-3">{{ $data->creator->name ?? '-' }}
                                </td>

                                <td class="p-3 text-center">
                                    <a href="{{ route('absensi.show', $data->id) }}">
                                        @if ($data->absensi->count() > 0)
                                            <x-btn-primary><i
                                                    class="fi
                            fi-rs-eye leading-none relative top-0.5"></i>
                                            </x-btn-primary>
                                        @elseif ($data->absensi->isEmpty())
                                            @if (Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
                                                <x-btn-warning><i
                                                        class="fi
                            fi-rs-plus leading-none relative top-0.5"></i>
                                                </x-btn-warning>
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </a>
                                </td>
                                @if (Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
                                    <td class="p-3 text-center">
                                        <a href="{{ route('notulensi.generate.form', $data->id) }}">
                                            @if (optional($data->notulensi)->count() > 0)
                                                <x-btn-primary>
                                                    <i class="fi fi-rs-eye leading-none relative top-0.5"></i>
                                                </x-btn-primary>
                                            @else
                                                <x-btn-warning>
                                                    <i class="fi fi-rs-plus leading-none relative top-0.5"></i>
                                                </x-btn-warning>
                                            @endif

                                        </a>
                                    </td>
                                    <td class="p-3 text-center">
                                        <a href="{{ route('berita_acara.generate.form', $data->id) }}">
                                            @if (optional($data->berita_acara)->count() > 0)
                                                <x-btn-primary>
                                                    <i class="fi fi-rs-eye leading-none relative top-0.5"></i>
                                                </x-btn-primary>
                                            @else
                                                <x-btn-warning>
                                                    <i class="fi fi-rs-plus leading-none relative top-0.5"></i>
                                                </x-btn-warning>
                                            @endif
                                        </a>
                                    </td>
                                @endif
                                <td class="p-3">
                                    <div class="flex items-center gap-2 text-center">
                                        @if (
                                            $data->created_by == Auth::user()->id ||
                                                Auth::user()->role == 'sekretaris' ||
                                                Auth::user()->role == 'admin' ||
                                                Auth::user()->role == 'ketua' ||
                                                Auth::user()->role == 'wakil')
                                            <x-btn-warning data-modal-target="editModal{{ $data->id }}"><i
                                                    class="fi fi-rs-pencil leading-none relative top-0.5"></i></x-btn-warning>
                                        @else
                                            <x-btn-secondary disabled><i
                                                    class="fi fi-rs-pencil leading-none relative top-0.5"></i></x-btn-secondary>
                                        @endif

                                        @if (Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
                                            <x-btn-danger data-modal-target="deleteModal{{ $data->id }}"><i
                                                    class="fi fi-rs-trash leading-none relative top-0.5"></i></x-btn-danger>
                                        @endif
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
                                                <!-- pemimpin_rapat_id -->
                                                @if (Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
                                                    <div>
                                                        <x-label for="pemimpin_rapat_id">Pemimpin Rapat</x-label>
                                                        <x-select-input id="pemimpin_rapat_id" class="w-full"
                                                            name="pemimpin_rapat_id">
                                                            <option selected disabled>-- Pilih Pemimpin Rapat --
                                                            </option>
                                                            @foreach ($pemimpin_rapat as $rapats)
                                                                <option value="{{ $rapats->id }}"
                                                                    {{ old('pemimpin_rapat_id') == $rapats->id || $data->pemimpin_rapat_id == $rapats->id ? 'selected' : '' }}>
                                                                    {{ $rapats->name }}
                                                                </option>
                                                            @endforeach
                                                        </x-select-input>
                                                        <x-error-message for="pemimpin_rapat_id" />
                                                    </div>
                                                @endif
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
                                                {{-- <div>
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
                                                </div> --}}

                                                <!-- link_dokumentasi -->
                                                <div>
                                                    <x-label for="link_dokumentasi_foto">Link Dokumentasi
                                                        Foto</x-label>
                                                    <x-text-input class="w-full" id="link_dokumentasi_foto"
                                                        name="link_dokumentasi_foto" type="text"
                                                        placeholder="Link Dokumentasi Foto..."
                                                        value="{{ old('link_dokumentasi_foto', $data->link_dokumentasi_foto) }}" />
                                                    <x-error-message for="link_dokumentasi_foto" />
                                                </div>

                                                <!-- link_dokumentasi -->
                                                <div>
                                                    <x-label for="link_dokumentasi_video">Link Dokumentasi
                                                        Video</x-label>
                                                    <x-text-input class="w-full" id="link_dokumentasi_video"
                                                        name="link_dokumentasi_video" type="text"
                                                        placeholder="Link Dokumentasi Video..."
                                                        value="{{ old('link_dokumentasi_video', $data->link_dokumentasi_video) }}" />
                                                    <x-error-message for="link_dokumentasi_video" />
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
                                                    ini? Jika menghapusnya maka akan menghapus semua data yang terkait
                                                    (Absensi, Notulensi, dan BAP)
                                                    .
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
                                @if (Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
                                    <td colspan="11" class="text-center p-5">Belum ada data kegiatan hari ini.</td>
                                @else
                                    <td colspan="9" class="text-center p-5">Belum ada data kegiatan hari ini.</td>
                                @endif
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination would go here -->
        <div class="p-4 border-t border-gray-200">
            {{ $kegiatan->links() }}
        </div>
    </div>

</x-app-layout>
