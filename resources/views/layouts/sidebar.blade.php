<!-- Logo -->
<div class="flex items-center justify-between px-6 py-5">
    <div class="text-indigo-700 text-2xl font-bold flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
        <span class="ml-2">Admin.</span>
    </div>
    <button onclick="toggleSidebar()" class="md:hidden text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<nav class="mt-4 space-y-2">
    <!-- Dashboard Active Item -->
    <div class="flex items-center mr-4">
        <!-- Garis kiri -->
        @if (request()->is('dashboard*'))
            <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
        @endif

        <!-- Card Menu -->
        <a href="/dashboard"
            class="flex items-center flex-1 px-4 py-3 {{ request()->is('dashboard*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3">
            <i class="fi fi-rs-home text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Dashboard</span>
        </a>
    </div>

    <!-- Data Master Dropdown -->
    <div x-data="{ open: {{ request()->is('dashboard*') || request()->is('user-manajemen*') ? 'true' : 'false' }} }" class="flex flex-col mr-4">
        <!-- Garis kiri untuk menu utama dropdown saat active -->
        <div class="flex items-center">
            @if (request()->is('dashboard*') || request()->is('user-manajemen*'))
                <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div>
            @endif

            <button @click="open = !open"
                class="flex items-center flex-1 px-4 py-3 {{ request()->is('dashboard*') || request()->is('user-manajemen*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg ml-3 relative">
                <i class="fi fi-rs-database text-lg leading-none relative top-0.5"></i>
                <span class="ml-3 font-medium">Data Master</span>
                <i class="fi text-2xl transition-all duration-200 ml-auto absolute right-4 top-1/2 -translate-y-1/3"
                    :class="open ? 'fi-rs-angle-small-up' : 'fi-rs-angle-small-down'"></i>
            </button>
        </div>

        <!-- Dropdown Content dengan Transisi -->
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="ml-8 mt-1.5 space-y-1">
            <!-- Submenu Produk -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-2 {{ request()->is('dashboard*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg">
                <i
                    class="fi fi-{{ request()->is('dashboard*') ? 'ss' : 'rs' }}-circle text-sm leading-none relative top-0.5"></i>
                <span class="ml-3 font-medium">Sample</span>
            </a>

            <!-- Submenu Kategori -->
            <a href="{{ route('user-manajemen.index') }}"
                class="flex items-center px-4 py-2 {{ request()->is('user-manajemen*') ? 'bg-indigo-100 text-indigo-800' : 'text-gray-500 hover:bg-gray-50' }} rounded-lg">
                <i
                    class="fi fi-{{ request()->is('user-manajemen*') ? 'ss' : 'rs' }}-circle text-sm leading-none relative top-0.5"></i>
                <span class="ml-3 font-medium">Sample</span>
            </a>
        </div>
    </div>

    <!-- Dashboard Active Item -->
    <div class="flex items-center mr-4">
        <!-- Garis kiri -->
        {{-- <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div> --}}

        <!-- Card Menu -->
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-lg ml-3">
            <i class="fi fi-rs-list text-lg leading-none relative top-0.5"></i>

            <span class="ml-3 font-medium">Produk</span>
        </a>
    </div>
    <div class="flex items-center mr-4">
        <!-- Garis kiri -->
        {{-- <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div> --}}

        <!-- Card Menu -->
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-lg ml-3">
            <i class="fi fi-rs-shop text-lg leading-none relative top-0.5"></i>

            <span class="ml-3 font-medium">Distributor</span>
        </a>
    </div>
    <div class="flex items-center mr-4">
        <!-- Garis kiri -->
        {{-- <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div> --}}

        <!-- Card Menu -->
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-lg ml-3">
            <i class="fi fi-rs-arrows-repeat text-lg leading-none relative top-0.5"></i>

            <span class="ml-3 font-medium">Konsinyasi</span>
        </a>
    </div>
    <div class="flex items-center mr-4">
        <!-- Garis kiri -->
        {{-- <div class="w-[5px] h-12 bg-indigo-700 rounded-r-md"></div> --}}

        <!-- Card Menu -->
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-lg ml-3">
            <i class="fi fi-rs-digital-payment text-lg leading-none relative top-0.5"></i>

            <span class="ml-3 font-medium">Realisasi</span>
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

            <span class="ml-3 font-medium">Manajemen User</span>
        </a>
    </div>
</nav>
