<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-journal-alt text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Notulensi Kegiatan</h2>
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
        <form action="{{ route('notulensi.generate', $kegiatan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Kegiatan -->
            <div class="mb-4">
                <x-label for="nama_kegiatan" required>Nama Kegiatan</x-label>
                <x-text-input name="nama_kegiatan" id="nama_kegiatan" class="w-full"
                    value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" />
                <x-error-message for="nama_kegiatan" />
            </div>

            <!-- Tanggal Kegiatan disabled-->
            <div class="mb-4">
                <x-label for="tgl_kegiatan">Hari & Tanggal Kegiatan</x-label>
                <x-text-input id="tgl_kegiatan" class="w-full bg-gray-200"
                    value="{{ optional($kegiatan->tgl_kegiatan ? Carbon\Carbon::parse($kegiatan->tgl_kegiatan) : null)->translatedFormat('l, d F Y') ?? '-' }}"
                    disabled />
                {{-- <x-error-message for="tgl_kegiatan" /> --}}
            </div>

            <!-- Waktu-->
            <div class="mb-4">
                <x-label for="waktu_mulai">Waktu Mulai</x-label>
                <x-text-input id="waktu_mulai" class="w-full bg-gray-200"
                    value="{{ $kegiatan->waktu_mulai ? \Carbon\Carbon::createFromFormat('H:i:s', $kegiatan->waktu_mulai)->format('H.i') : '-' }}"
                    disabled />
                {{-- <x-error-message for="waktu_mulai" /> --}}
            </div>

            <!-- Lokasi Kegiatan disabled-->
            <div class="mb-4">
                <x-label for="lokasi_kegiatan">Lokasi Kegiatan</x-label>
                <x-text-input name="lokasi_kegiatan" id="lokasi_kegiatan" class="w-full bg-gray-200"
                    value="{{ old('lokasi_kegiatan', $kegiatan->lokasi_kegiatan) }}" disabled />
                {{-- <x-error-message for="lokasi_kegiatan" /> --}}
            </div>

            <!-- Pemimpin Rapat disabled -->
            <div class="mb-4">
                <x-label for="pemimpin_rapat_id">Pemimpin Rapat</x-label>
                <x-text-input id="pemimpin_rapat_id" class="w-full bg-gray-200"
                    value="{{ $kegiatan->pemimpin_rapat->name ?? 'belum ada pemimpin rapat' }}" disabled />
                {{-- <x-error-message for="pemimpin_rapat_id" /> --}}
            </div>

            <!-- Notulis disabled-->
            <div class="mb-4">
                <x-label for="created_by">Notulis</x-label>
                <x-text-input id="created_by" class="w-full bg-gray-200" value="{{ $kegiatan->creator->name }}"
                    disabled />
                {{-- <x-error-message for="created_by" /> --}}
            </div>

            <!-- Hasil Kegiatan -->
            <div class="mb-4">
                <x-label for="hasil_kegiatan" required>Hasil Kegiatan</x-label>
                <textarea name="hasil_kegiatan" id="hasil_kegiatan" rows="5" class="w-full border-gray-300 rounded">{{ old('hasil_kegiatan', $kegiatan->hasil_kegiatan) }}</textarea>
                <x-error-message for="hasil_kegiatan" />
            </div>

            <!-- Kesimpulan -->
            <div class="mb-4">
                <x-label for="kesimpulan" required>Kesimpulan</x-label>
                <textarea name="kesimpulan" id="kesimpulan" rows="5" class="w-full border-gray-300 rounded">{{ old('kesimpulan', $kegiatan->notulensi?->kesimpulan) }}</textarea>
                <x-error-message for="kesimpulan" />
            </div>

            <!-- Tombol Generate -->
            <div class="flex justify-end mt-6">
                @if (isset($kegiatan->notulensi))
                    <x-btn-warning type="submit">Buat Ulang Notulensi</x-btn-warning>
                @elseif (!$kegiatan->notulensi)
                    <x-btn-primary type="submit">Buat Notulensi</x-btn-primary>
                @endif
            </div>
        </form>

        {{-- Jika sudah ada file notulensi --}}
        @if (isset($kegiatan->notulensi))
            <div class="mt-6 border-t pt-4">
                <h3 class="text-lg font-semibold mb-2">Lihat / Download Notulensi:</h3>
                <a href="{{ asset('storage/' . $kegiatan->notulensi->file_path) }}" target="_blank"
                    class="text-blue-600 hover:underline">
                    Download Notulensi ({{ $kegiatan->notulensi->nama_file }})
                </a>
            </div>
        @endif
    </div>





</x-app-layout>
