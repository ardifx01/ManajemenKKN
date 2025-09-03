<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KKN Desa Kersamaju - Kelompok 5</title>
    <link rel="shortcut icon" href="{{ asset('storage/' . $desa->logo) }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4E7B99',
                        secondary: '#2c5282',
                        accent: '#81C054', //hijau
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Animasi untuk section yang di-scroll ke */
        .section-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .section-scroll.active {
            opacity: 1;
            transform: translateY(0);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1a365d 0%, #2c5282 50%, #4299e1 100%);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            bottom: -8px;
            left: 25%;
            background-color: #4299e1;
        }
    </style>

    {{-- style hero section --}}
    <style>
        /* Animasi */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .animate-bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0) translateX(-50%);
            }

            40% {
                transform: translateY(-20px) translateX(-50%);
            }

            60% {
                transform: translateY(-10px) translateX(-50%);
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <!-- Header -->
    <header class="gradient-bg text-white">
        <div class="container mx-auto px-4 py-8 md:py-12">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-6 md:mb-0">
                    <div class="bg-white p-2 rounded-lg mr-4">
                        <img src="{{ asset('storage/' . $desa->logo) }}" alt="Logo KKN Desa Kersamaju"
                            class="h-16 w-auto">
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold">KKN DESA KERSAMAJU</h1>
                        <p class="text-accent-200 font-medium">Kelompok 5 - 2025</p>
                    </div>
                </div>
                <nav class="flex space-x-1 md:space-x-4">
                    <a href="#tentang"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-secondary transition">Tentang</a>
                    <a href="#struktur"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-secondary transition">Struktur</a>
                    <a href="#proker"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-secondary transition">Proker</a>
                    <a href="#kontak"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-secondary transition">Kontak</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center text-white overflow-hidden">
        <!-- Background Image dengan Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="/background-view.jpg" alt="Pemandangan Desa Kersamaju"
                class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-secondary/60"></div>
        </div>

        <!-- Content -->
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-4xl md:text-6xl font-bold mb-6 animate-fadeInUp">Selamat Datang di Desa Kersamaju</h2>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto mb-8 animate-fadeInUp delay-100">
                Kelompok 5 KKN 2025 siap berkontribusi untuk kemajuan Desa Kersamaju melalui berbagai program kerja yang
                bermanfaat.
            </p>
            <a href="#proker"
                class="bg-accent hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-full inline-block transition duration-300 transform hover:scale-105"
                onclick="smoothScroll('#proker')">
                Lihat Program Kami
            </a>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <a href="#tentang" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="section-scroll py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 section-title">Tentang Kami</h2>
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                    <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Desa Kersamaju" class="rounded-lg shadow-xl w-full h-auto">
                </div>
                <div class="md:w-1/2">
                    <h3 class="text-2xl font-semibold mb-4 text-primary">KKN Desa Kersamaju 2025</h3>
                    <p class="text-gray-700 mb-4">Kelompok 5 Kuliah Kerja Nyata (KKN) tahun 2025 hadir di Desa Kersamaju
                        dengan semangat untuk berkontribusi dalam pembangunan desa melalui berbagai program kerja yang
                        disusun berdasarkan kebutuhan masyarakat.</p>
                    <p class="text-gray-700 mb-4">Kami berkomitmen untuk melaksanakan program-program yang berorientasi
                        pada pemberdayaan masyarakat, pendidikan, kesehatan, dan pengembangan potensi lokal Desa
                        Kersamaju.</p>
                    <p class="text-gray-700">Dengan semangat gotong royong, kami siap bekerja sama dengan pemerintah
                        desa dan seluruh elemen masyarakat untuk mewujudkan Desa Kersamaju yang lebih maju dan
                        sejahtera.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi -->
    <section id="struktur" class="section-scroll py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 section-title">Struktur Organisasi</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Pembimbing -->
                @foreach ($anggotas as $anggota)
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden card-hover transition duration-300 hover:shadow-lg">
                        <!-- Photo Section -->
                        <div
                            class="bg-gray-100 flex items-center justify-center overflow-hidden h-80 sm:h-96 md:h-[28rem]">
                            @if ($anggota->user->foto == 'profile.png')
                                <img src="/profile.png" alt="Foto Profil" class="h-full w-full object-cover object-top">
                            @else
                                <img src="{{ asset('storage/' . $anggota->user->foto) }}" alt="Foto Profil"
                                    class="h-full w-full object-cover object-top">
                            @endif
                        </div>



                        <!-- Info Section -->
                        <div class="p-6 flex flex-col items-center text-center">
                            <!-- Changed to flex-col and centered -->
                            <h3 class="text-xl font-semibold text-primary mb-1">{{ $anggota->user->name }}
                            </h3>
                            <p class="text-gray-800 font-medium mb-4">{{ $anggota->jabatan->nama_jabatan }}</p>

                            <!-- Social Media Icons - Centered -->
                            <div class="flex justify-center space-x-4 pt-3 border-t border-gray-100 w-full">
                                <!-- Added justify-center -->

                                @if ($anggota->user->instagram)
                                    <!-- Instagram -->
                                    <a href="{{ $anggota->user->instagram }}"
                                        class="text-gray-500 hover:text-pink-600 transition-colors" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                    </a>
                                @endif

                                @if ($anggota->user->tiktok)
                                    <!-- TikTok -->
                                    <a href="{{ $anggota->user->tiktok }}"
                                        class="text-gray-500 hover:text-black transition-colors" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                        </svg>
                                    </a>
                                @endif

                                @if ($anggota->user->facebook)
                                    <!-- Facebook -->
                                    <a href="{{ $anggota->user->facebook }}"
                                        class="text-gray-500 hover:text-blue-800 transition-colors" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82V14.709h-3.1v-3.622h3.1V8.413c0-3.066 1.873-4.739 4.605-4.739 1.311 0 2.438.098 2.766.142v3.208l-1.899.001c-1.491 0-1.78.709-1.78 1.75v2.296h3.562l-.465 3.622h-3.097V24h6.076c.73 0 1.324-.593 1.324-1.324V1.325C24 .593 23.407 0 22.675 0z" />
                                        </svg>
                                    </a>
                                @endif

                                @if ($anggota->user->web)
                                    <!-- Website (Globe Icon) -->
                                    <a href="{{ $anggota->user->web }}"
                                        class="text-gray-500 hover:text-blue-500 transition-colors" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 0c2.21 0 4 4.03 4 9s-1.79 9-4 9-4-4.03-4-9 1.79-9 4-9zm0 0h.01M2 12h20" />
                                        </svg>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Program Kerja -->
    <section id="proker" class="section-scroll py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 section-title">Program Kerja</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Proker 1 -->
                @foreach ($proker as $prokers)
                    <div class="bg-gray-50 rounded-lg overflow-hidden shadow-md card-hover transition duration-300">
                        <div
                            class="h-48 bg-gradient-to-r from-primary to-accent flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-primary mb-2">{{ $prokers->nama_proker }}</h3>
                            <p class="text-gray-700 mb-4">{{ $prokers->deskripsi }}</p>
                            <div class="flex justify-between text-sm text-gray-500">
                                @if ($prokers->tgl_mulai)
                                    <span>{{ optional($prokers->tgl_mulai)->translatedFormat('d F Y') ?? '' }} -
                                        {{ optional($prokers->tgl_selesai)->translatedFormat('d F Y') ?? 'Selesai' }}</span>
                                @endif
                                @php
                                    $status = strtolower($prokers->status);
                                    $badgeColor = match ($status) {
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'berjalan' => 'bg-blue-100 text-blue-800',
                                        'selesai' => 'bg-green-100 text-green-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp

                                <span
                                    class="ms-auto px-3 py-1 rounded-full text-sm font-semibold {{ $badgeColor }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 section-title">Hubungi Kami</h2>

            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-1/2">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-primary mb-4">Kirim Pesan atau Aspirasi</h3>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 mb-2">Nama</label>
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-accent">
                                @error('name')
                                    <span class="text-red-500 italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-accent">
                                @error('email')
                                    <span class="text-red-500 italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="message" class="block text-gray-700 mb-2">Pesan</label>
                                <textarea id="message" rows="4" name="message"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-accent"></textarea>
                                @error('message')
                                    <span class="text-red-500 italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit"
                                class="bg-primary hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">Kirim</button>
                        </form>
                    </div>
                </div>

                <div class="md:w-1/2">
                    <div class="bg-white p-8 rounded-lg shadow-md h-full">
                        <h3 class="text-xl font-semibold text-primary mb-4">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11 text-primary mr-4 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <h4 class="font-medium text-gray-800">Alamat</h4>
                                    <p class="text-gray-600">{{ $desa->alamat ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-4 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div>
                                    <h4 class="font-medium text-gray-800">Telepon</h4>
                                    <p class="text-gray-600">{{ $desa->telepon ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-4 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <h4 class="font-medium text-gray-800">Email</h4>
                                    <p class="text-gray-600">{{ $desa->email ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-4 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <div>
                                    <h4 class="font-medium text-gray-800">Media Sosial</h4>
                                    <div class="flex space-x-4 mt-2">
                                        {{-- Instagram --}}
                                        @if ($desa->instagram)
                                            <a href="{{ $desa->instagram }}"
                                                class="text-black hover:opacity-70 transition-opacity"
                                                target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                                    {{-- path asli Instagram --}}
                                                </svg>
                                            </a>
                                        @endif

                                        {{-- TikTok --}}
                                        @if ($desa->tiktok)
                                            <a href="{{ $desa->tiktok }}"
                                                class="text-black hover:opacity-70 transition-opacity"
                                                target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                                    {{-- path asli TikTok --}}
                                                </svg>
                                            </a>
                                        @endif

                                        {{-- Website --}}
                                        @if ($desa->web)
                                            <a href="{{ $desa->web }}"
                                                class="text-black hover:opacity-70 transition-opacity"
                                                target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5.93 6h-3.17a15.86 15.86 0 0 0-1.1-3.76A8.048 8.048 0 0 1 17.93 8zM12 4.07c.58.87 1.1 2.02 1.43 3.43h-2.86c.33-1.41.85-2.56 1.43-3.43zM4.26 16a7.932 7.932 0 0 1-.81-4H8c.04 1.44.21 2.79.48 4H4.26zM4.26 8H8c-.27 1.21-.44 2.56-.48 4H3.45a7.932 7.932 0 0 1 .81-4zM12 19.93c-.58-.87-1.1-2.02-1.43-3.43h2.86c-.33 1.41-.85 2.56-1.43 3.43zM14.24 16h-4.48a13.986 13.986 0 0 1-.53-4c0-1.43.19-2.79.53-4h4.48c.34 1.21.53 2.57.53 4s-.19 2.79-.53 4zm.33 3.76c.49-.96.88-2.1 1.1-3.76h3.17a8.048 8.048 0 0 1-4.27 3.76zM6.07 16h3.17a15.86 15.86 0 0 0 1.1 3.76A8.048 8.048 0 0 1 6.07 16zM6.07 8A8.048 8.048 0 0 1 10.34 4.24 15.86 15.86 0 0 0 9.24 8H6.07zm11.88 8h-3.17c.22-1.66.61-2.8 1.1-3.76A8.048 8.048 0 0 1 17.95 16z" />
                                                    {{-- path asli globe/web --}}
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="gradient-bg text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $desa->logo) }}" alt="Logo KKN Desa Kersamaju"
                            class="h-12 w-auto mr-4">
                        <div>
                            <h3 class="text-xl font-bold">KKN DESA KERSAMAJU</h3>
                            <p class="text-accent-200">Kelompok 5 - 2025</p>
                        </div>
                    </div>
                </div>
                <div class="text-center md:text-right">
                    <p>&copy; 2025 KKN Desa Kersamaju Kelompok 5. All rights reserved.</p>
                    <p class="text-sm text-accent-200 mt-1">Dibuat dengan semangat untuk Desa Kersamaju</p>
                </div>
            </div>
        </div>
    </footer>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ $errors->first() }}',
            });
        </script>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk handle smooth scroll
            function smoothScroll(target) {
                const element = document.querySelector(target);
                if (element) {
                    // Hitung posisi element
                    const elementPosition = element.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset -
                        80; // 80 adalah offset untuk header

                    // Trigger smooth scroll
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Tambahkan class active setelah scroll selesai
                    setTimeout(() => {
                        element.classList.add('active');
                    }, 600); // Sesuaikan dengan durasi scroll
                }
            }

            // Handle klik pada semua link dengan hash (#)
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('href');
                    smoothScroll(target);
                });
            });

            // Handle scroll untuk trigger animasi
            function handleScrollAnimation() {
                const sections = document.querySelectorAll('.section-scroll');
                const scrollPosition = window.pageYOffset + (window.innerHeight * 0.8);

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;

                    if (scrollPosition > sectionTop && scrollPosition < sectionTop + sectionHeight) {
                        section.classList.add('active');
                    }
                });
            }

            // Jalankan saat load dan scroll
            window.addEventListener('load', handleScrollAnimation);
            window.addEventListener('scroll', handleScrollAnimation);
        });
    </script>
</body>

</html>
