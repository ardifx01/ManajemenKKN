<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-journal-alt text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Berita Acara Kegiatan</h2>
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

    <div class="my-4 bg-white border border-gray-200 rounded-lg shadow-sm p-6">
        <form action="{{ route('berita_acara.generate', $kegiatan->id) }}" method="POST">
            @csrf

            <!-- Pokok Bahasan -->
            <div class="mb-4">
                <x-label for="pokok_bahasan" required>Pokok Bahasan</x-label>
                <x-text-input name="pokok_bahasan" id="pokok_bahasan" class="w-full"
                    value="{{ old('pokok_bahasan', $kegiatan->nama_kegiatan) }}" />
                <x-error-message for="pokok_bahasan" />
            </div>

            <!-- Penanggungjawab -->
            <div class="mb-4">
                <x-label for="nama_penanggungjawab">Nama Penanggung Jawab</x-label>
                <x-text-input name="nama_penanggungjawab" id="nama_penanggungjawab" class="w-full"
                    value="{{ old('nama_penanggungjawab', $bap?->nama_penanggungjawab) }}" />
                <x-error-message for="nama_penanggungjawab" />
            </div>


            <!-- Tanggal Kegiatan disabled-->
            <div class="mb-4">
                <x-label for="tgl_kegiatan" required>Hari & Tanggal</x-label>
                <x-text-input id="tgl_kegiatan" name="tgl_kegiatan" class="w-full bg-gray-200"
                    value="{{ optional($kegiatan->tgl_kegiatan ? Carbon\Carbon::parse($kegiatan->tgl_kegiatan) : null)->translatedFormat('d F Y') ?? '-' }}" />
                {{-- <x-error-message for="tgl_kegiatan" /> --}}
            </div>

            <!-- Lokasi Kegiatan disabled-->
            <div class="mb-4">
                <x-label for="lokasi_kegiatan">Lokasi</x-label>
                <x-text-input name="lokasi_kegiatan" id="lokasi_kegiatan" class="w-full bg-gray-200"
                    value="{{ old('lokasi_kegiatan', $kegiatan->lokasi_kegiatan) }}" />
                {{-- <x-error-message for="lokasi_kegiatan" /> --}}
            </div>

            <!-- Waktu Kegiatan disabled-->
            <div class="flex gap-2 mb-4">
                <div>
                    <x-label for="waktu_mulai">Waktu Mulai</x-label>
                    <x-text-input type="time" name="waktu_mulai" id="waktu_mulai" class="w-full bg-gray-200"
                        value="{{ old('waktu_mulai', \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('H:i')) }}" />
                    {{-- <x-error-message for="waktu_mulai" /> --}}
                </div>
                <div>
                    <x-label for="waktu_selesai">Waktu Selesai</x-label>
                    <x-text-input type="time" name="waktu_selesai" id="waktu_selesai" class="w-full bg-gray-200"
                        value="{{ old('waktu_selesai', \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('H:i')) }}" />
                    {{-- <x-error-message for="waktu_selesai" /> --}}
                </div>
            </div>

            <!-- Jumlah Anggota -->
            {{-- <div class="flex gap-2 mb-4"> --}}
            <div class="mb-4">
                <x-label for="jml_anggota" required>Jumlah Peserta Hadir</x-label>
                <x-text-input id="jml_anggota" name="jml_anggota" class="w-full"
                    value="{{ old('jml_anggota', $bap?->jml_anggota) }}" />
                <x-error-message for="jml_anggota" />
            </div>
            {{-- <!-- Jumlah Tidak hadir -->
                <div>
                    <x-label for="jml_tidak_hadir">Tidak Hadir</x-label>
                    <x-text-input id="jml_tidak_hadir" name="jml_tidak_hadir" class="w-full"
                        value="{{ old('jml_tidak_hadir', $bap?->jml_tidak_hadir) }}" />
                    <x-error-message for="jml_tidak_hadir" />
                </div> --}}
            {{-- </div> --}}

            <!-- Nama Anggota tidak hadir -->
            {{-- <div class="mb-4">
                <x-label for="nama_anggota_tidak_hadir">Nama Anggota tidak hadir</x-label>
                <textarea name="nama_anggota_tidak_hadir" id="nama_anggota_tidak_hadir" rows="5"
                    class="w-full border-gray-300 rounded">{{ old('nama_anggota_tidak_hadir', $bap?->nama_anggota_tidak_hadir) }}</textarea>
                <x-error-message for="nama_anggota_tidak_hadir" />
            </div> --}}

            <!-- Uraian Kejadian -->
            <div class="mb-4">
                <x-label for="uraian_kejadian" required>Uraian Kejadian</x-label>
                <textarea name="uraian_kejadian" id="uraian_kejadian" rows="5" class="w-full border-gray-300 rounded">{{ old('uraian_kejadian', $bap?->uraian_kejadian) }}</textarea>
                <x-error-message for="uraian_kejadian" />
            </div>

            <!-- Tanggal Kegiatan -->
            {{-- <div class="mb-4">
                <x-label for="tgl_kegiatan" required>Tanggal Kegiatan</x-label>
                <x-text-input type="date" id="tgl_kegiatan" name="tgl_kegiatan" class="w-full"
                    value="{{ $kegiatan->tgl_kegiatan }}" />
                <x-error-message for="tgl_kegiatan" />
            </div> --}}

            <!-- Nama Ketua Kelompok -->
            <div class="mb-4">
                <x-label for="nama_ketua_kelompok" required>Nama Ketua Kelompok</x-label>
                <x-text-input id="nama_ketua_kelompok" name="nama_ketua_kelompok" class="w-full bg-gray-200"
                    value="Hervian Ervansyah" />
                {{-- <x-error-message for="" /> --}}
            </div>

            <!-- Tombol Generate -->
            <div class="flex justify-end mt-6">
                @if (isset($kegiatan->berita_acara))
                    <x-btn-warning type="submit">Buat Ulang BAP</x-btn-warning>
                @elseif (!$kegiatan->berita_acara)
                    <x-btn-primary type="submit">Buat BAP</x-btn-primary>
                @endif
            </div>
        </form>

        {{-- Jika sudah ada file Berita Acara --}}
        @if (isset($kegiatan->berita_acara))
            <div class="mt-6 border-t pt-4">
                <h3 class="text-lg font-semibold mb-2">Lihat / Download Berita Acara:</h3>
                <a href="{{ asset('storage/' . $kegiatan->berita_acara->file_path) }}" target="_blank"
                    class="text-blue-600 hover:underline">
                    Download Berita Acara ({{ $kegiatan->berita_acara->nama_file }})
                </a>
            </div>
        @endif
    </div>





</x-app-layout>
