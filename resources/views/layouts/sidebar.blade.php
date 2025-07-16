<!-- Logo -->
<div class="relative pt-1.5">
    <div class="flex justify-center items-center">
        <img src="{{ asset('storage/' . $profile->logo) }}" width="70" alt="Logo">
    </div>
    <button onclick="toggleSidebar()" class="absolute right-6 top-1/2 -translate-y-1/2 md:hidden text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<hr class="mt-2">


<nav class="mt-2 space-y-2">
    <!-- Dashboard Active Item -->
    @if (Auth::user()->role == 'admin')
        @include('layouts.sidebar-role.admin')
    @elseif(Auth::user()->role == 'pembimbing' || Auth::user()->role == 'ketua' || Auth::user()->role == 'wakil')
        @include('layouts.sidebar-role.pembimbing_ketua_wakil')
    @elseif(Auth::user()->role == 'bendahara')
        @include('layouts.sidebar-role.bendahara')
    @elseif(Auth::user()->role == 'sekretaris')
        @include('layouts.sidebar-role.sekretaris')
    @elseif(Auth::user()->role == 'user')
        @include('layouts.sidebar-role.user')
    @endif
</nav>
