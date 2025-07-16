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
    @if (request()->is('profil-kkn*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="{{ route('profil-kkn.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('profil-kkn*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-hr-group text-lg leading-none relative top-0.5"></i>

        <span class="ml-3 font-medium">Profil KKN</span>
    </a>
</div>
<div class="flex items-center mr-4">
    <!-- Garis kiri -->
    @if (request()->is('jabatan*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="{{ route('jabatan.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('jabatan*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-admin-alt text-lg leading-none relative top-0.5"></i>

        <span class="ml-3 font-medium">Setting Jabatan</span>
    </a>
</div>
<div class="flex items-center mr-4">
    <!-- Garis kiri -->
    @if (request()->is('user-manajemen*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="{{ route('user-manajemen.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('user-manajemen*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-users text-lg leading-none relative top-0.5"></i>

        <span class="ml-3 font-medium">Kelola Anggota</span>
    </a>
</div>

<div class="flex items-center mr-4">
    <!-- Garis kiri -->
    @if (request()->is('proker*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif
    <!-- Card Menu -->
    <a href="{{ route('proker.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('proker*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-list text-lg leading-none relative top-0.5"></i>

        <span class="ml-3 font-medium">Program Kerja</span>
    </a>
</div>

<div class="flex items-center mr-4">
    <!-- Garis kiri -->
    @if (request()->is('kegiatan*') ||
            request()->is('absensi*') ||
            request()->is('notulensi/generate*') ||
            request()->is('berita_acara/generate*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="{{ route('kegiatan.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('kegiatan*') || request()->is('absensi*') || request()->is('notulensi/generate*') || request()->is('berita_acara/generate*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
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
    @if (request()->is('keuangan*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="{{ route('keuangan.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('keuangan*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-wallet text-lg leading-none relative top-0.5"></i>

        <span class="ml-3 font-medium">Input Keuangan</span>
    </a>
</div>
<div class="flex items-center mr-4">
    <!-- Garis kiri -->
    @if (request()->is('laporan-keuangan*'))
        <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
    @endif

    <!-- Card Menu -->
    <a href="{{ route('laporan-keuangan.index') }}"
        class="flex items-center flex-1 px-4 py-3 {{ request()->is('laporan-keuangan*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
        <i class="fi fi-rs-chart-mixed-up-circle-dollar text-lg leading-none relative top-0.5"></i>

        <span class="ml-3 font-medium">Laporan Keuangan</span>
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
