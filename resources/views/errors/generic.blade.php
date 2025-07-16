<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Errors</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-6 py-12">
        <div class="text-center max-w-md">
            <div class="mx-auto w-24 h-24 mb-6 flex items-center justify-center rounded-full bg-red-100 text-red-600">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01M12 6.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13z" />
                </svg>
            </div>

            <h1 class="text-6xl font-bold text-gray-800 mb-2">{{ $code ?? 'Error' }}</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">{{ $title ?? 'Terjadi Kesalahan' }}</h2>
            <p class="text-gray-500 mb-6">
                {{ $message ?? 'Halaman yang Anda cari tidak ditemukan atau Anda tidak memiliki akses.' }}
            </p>

            <a href="{{ url()->previous() ?? route('/') }}"
                class="inline-block px-6 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded shadow">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>

</html>
