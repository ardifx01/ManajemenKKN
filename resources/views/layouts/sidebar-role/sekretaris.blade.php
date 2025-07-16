<!-- Dashboard Active Item -->
<div class="flex items-center mr-4">
    <!-- Garis kiri -->
    @if (request()->is('dashboard*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="/dashboard"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('dashboard*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-chart-histogram text-lg leading-none relative top-0.5"></i>
        <span class="ml-3 font-medium">Dashboard</span>
    </a>
</div>

<div class="flex items-center mr-4">
    <!-- Garis kiri -->
    @if (request()->is('kegiatan*') || request()->is('absensi*') || request()->is('notulensi/generate*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="{{ route('kegiatan.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('kegiatan*') || request()->is('absensi*') || request()->is('notulensi/generate*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-journal-alt text-lg leading-none relative top-0.5"></i>

        <span class="ml-3 font-medium">Input Kegiatan</span>
    </a>
</div>
<div class="flex items-center mr-4">
    <!-- Garis kiri -->
    @if (request()->is('laporan-kegiatan*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="{{ route('laporan-kegiatan.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('laporan-kegiatan*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-book-bookmark text-lg leading-none relative top-0.5"></i>

        <span class="ml-3 font-medium">Laporan Kegiatan</span>
    </a>
</div>
<div class="flex items-center mr-4">
    <!-- Garis kiri -->
    @if (request()->is('kotak-pesan*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="{{ route('kotak-pesan.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('kotak-pesan*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-messages text-lg leading-none relative top-0.5"></i>

        <span class="ml-3 font-medium">Kotak Pesan</span>
    </a>
</div>
