<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">Dashboard</h2>
    </x-slot>

    <!-- Row 1: Saldo & Total Proker -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <!-- Saldo Kas -->
        <div class="bg-white p-6 rounded-lg shadow flex flex-col justify-center items-center">
            <h2 class="text-xl font-bold text-gray-700 mb-2">Saldo Kas</h2>
            <p class="text-3xl font-semibold text-green-600">Rp{{ number_format($saldo, 0, ',', '.') }}</p>
        </div>

        <!-- Kegiatan Hari Ini -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Kegiatan Hari Ini</h2>
            <ul class="space-y-3 text-gray-700 list-disc pl-5">
                @forelse ($kegiatans as $kegiatan)
                    <li>{{ $kegiatan->nama_kegiatan }}</li>
                @empty
                    <li>Belum ada kegiatan hari ini</li>
                @endforelse
            </ul>
        </div>


    </div>

    <!-- Row 2: Daftar Proker & Kegiatan Hari Ini -->
    {{-- <div class="grid grid-cols-1 md:grid-cols-1 gap-4"> --}}
    <!-- Daftar Program Kerja -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Daftar Program Kerja ({{ $proker->count() }})</h2>
        <ul class="space-y-3 text-gray-700 list-disc pl-5">
            @forelse ($proker as $prokers)
                <li>{{ $prokers->nama_proker }} - {{ $prokers->tgl_mulai ?? '' }}</li>
            @empty
                <li>Belum ada program kerja</li>
            @endforelse
        </ul>
    </div>
    {{-- </div> --}}
</x-app-layout>
