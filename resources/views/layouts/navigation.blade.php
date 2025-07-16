<header class="bg-white shadow-sm">
    <div class="flex justify-between items-center px-4 md:px-8 py-4">
        <div class="flex items-center">
            <!-- Mobile Menu Button -->
            <button onclick="toggleSidebar(); document.getElementById('overlay').classList.toggle('hidden');"
                class="mr-4 text-gray-600 md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-xl font-medium text-gray-800">Simanajemen-KKN</h1>
        </div>

        <div class="flex items-center space-x-2 md:space-x-4 relative" x-data="{ open: false }">

            {{-- Messages Icon --}}
            <div class="relative">
                <a href="{{ route('kotak-pesan.index') }}">
                    <button class="p-2 rounded-full hover:bg-gray-100 relative focus:outline-none">
                        <!-- Messages Icon (Kotak) -->
                        <i class="fi fi-rs-messages text-lg leading-none relative top-0.5 h-6 w-6 text-gray-500"></i>

                        <!-- Red Dot Notification -->
                        <span
                            class="absolute top-[-1px] right-[-2px] text-red-500 font-semibold">{{ $pesan }}</span>
                    </button>
                </a>
            </div>

            {{-- Notifications Icon --}}
            {{-- <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-100 relative focus:outline-none">
                    <!-- Bell Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>

                    <!-- Red Dot Notification -->
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-ping"></span>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                    <div class="py-2">
                        <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                            </svg>
                            Sistem berhasil diupdate.
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Data transaksi baru masuk.
                        </a>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200"></div>

                    <!-- View All Link -->
                    <div class="py-2">
                        <a href="/notifications"
                            class="block text-center text-sm text-blue-600 font-medium hover:bg-gray-100 px-4 py-2">
                            View All Notifications
                        </a>
                    </div>
                </div>
            </div> --}}

            <!-- User Menu -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center border-2 border-indigo-100 space-x-2 p-2 rounded-full hover:bg-indigo-100 focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden">
                        @if (Auth::user()->foto == 'profile.png')
                            <img src="/profile.png" alt="User profile" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="User profile"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    @if (auth()->check())
                        <span class="text-gray-700 font-medium hidden md:inline">{{ Auth::user()->name }}</span>
                    @endif
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden">
                    <!-- User Info Section -->
                    <div class="px-4 py-3 border-b border-gray-200 bg-gray-200 text-center">
                        @if (auth()->check())
                            <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-500 truncate">{{ Auth::user()->role }}
                            </div>
                        @endif
                    </div>

                    <!-- Menu Items with Icons -->
                    <div class="py-1">
                        <a href="{{ route('profile.index') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fi fi-rs-user text-lg leading-none w-5 mr-2"></i>
                            <span>Profile</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fi fi-rs-sign-out-alt text-lg leading-none w-5 mr-2"></i>
                                <span>Logout</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</header>
