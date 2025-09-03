<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-journal-alt text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Absensi Kegiatan</h2>
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
            <div class="flex items-center justify-between gap-4">

                {{-- <form action="{{ route('absensi.index') }}" method="GET" class="flex items-center gap-2"> --}}
                <div>
                    <h1 class="text-lg">{{ $kegiatan->nama_kegiatan }} -
                        {{ optional($kegiatan->tgl_kegiatan ? Carbon\Carbon::parse($kegiatan->tgl_kegiatan) : null)->translatedFormat('l, d F Y') ?? '-' }}
                    </h1>
                </div>


                {{-- </form> --}}

                <div class="flex items-center gap-2">
                    {{-- <a href="#"
                        class="flex items-center py-2.5 px-2 md:py-2 border border-green-600 text-green-600 hover:bg-green-600 hover:text-white transition-colors duration-300 rounded-md">
                        Export Excel
                    </a> --}}
                    @if ($kegiatan->absensi->count() > 0)
                        <a href="{{ route('absensi.print', $kegiatan->id) }}" target="_blank"
                            class="flex items-center py-2.5 px-2 md:py-2 border border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition-colors duration-300 rounded-md">
                            Export PDF
                        </a>
                    @endif
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
                            <th scope="col" class="px-2 py-3 w-12 text-center">No.</th>
                            <th scope="col" class="p-3">Nama</th>
                            <th scope="col" class="p-3">No. HP</th>
                            <th scope="col" class="p-3">Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($absensi->isEmpty())
                            <form action="{{ route('absensi.store') }}" method="post">
                                @csrf
                                @forelse ($users as $data)
                                    <tr class="bg-white text-gray-900 border-b hover:bg-gray-100">
                                        <td class="px-2 py-3 text-center">{{ $loop->iteration }}</td>
                                        <td class="p-3 ">{{ $data->name }}</td>
                                        <td class="p-3 ">{{ $data->telepon }}</td>
                                        <td class="p-3">
                                            <select name="absensi[{{ $data->id }}]" id="">
                                                <option value="H">Hadir</option>
                                                <option value="I">Izin</option>
                                                <option value="S">Sakit</option>
                                                <option value="A">Alfa</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <input type="hidden" name="laporan_kegiatan_id" value="{{ $kegiatan->id }}">
                                    <input type="hidden" name="user_id" value="{{ $data->id }}">
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-5">Data tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="3" class="p-3"></td>
                                    <td class="p-3">
                                        <x-btn-primary type="submit">Simpan</x-btn-primary>
                                    </td>
                                </tr>
                            </form>
                        @elseif ($absensi)
                            <form action="{{ route('absensi.update', $id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="laporan_kegiatan_id" value="{{ $id }}">

                                @forelse ($absensi as $absen)
                                    <tr class="bg-white text-gray-900 border-b hover:bg-gray-100">
                                        <td class="px-2 py-3 text-center">{{ $loop->iteration }}</td>
                                        <td class="p-3 ">{{ $absen->user->name ?? '-' }}</td>
                                        <td class="p-3 ">{{ $absen->user->telepon ?? '-' }}</td>
                                        <td class="p-3">
                                            @if (Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
                                                <select name="absensi[{{ $absen->user_id }}]" id="">
                                                    <option value="H"
                                                        {{ $absen->status == 'H' ? 'selected' : '' }}>
                                                        Hadir
                                                    </option>
                                                    <option value="I"
                                                        {{ $absen->status == 'I' ? 'selected' : '' }}>
                                                        Izin
                                                    </option>
                                                    <option value="S"
                                                        {{ $absen->status == 'S' ? 'selected' : '' }}>
                                                        Sakit
                                                    </option>
                                                    <option value="A"
                                                        {{ $absen->status == 'A' ? 'selected' : '' }}>
                                                        Alfa
                                                    </option>
                                                </select>
                                            @else
                                                <x-text-input class="w-14 text-center bg-gray-200"
                                                    value="{{ $absen->status }}" disabled />
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-5">Data tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                                @if (Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
                                    <tr>
                                        <td colspan="3" class="p-3"></td>
                                        <td class="p-3">
                                            <x-btn-warning data-modal-target="addModal">Simpan Perubahan</x-btn-warning>
                                        </td>
                                    </tr>
                                @endif
                            </form>
                        @endif
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
