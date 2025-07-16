<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-wallet text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Input Keuangan</h2>
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

    <div class="my-4 bg-white border border-gray-200 rounded-lg shadow-sm">
        <!-- Header with controls -->
        <div class="p-4 border-b border-gray-200">
            <div class="flex items-center justify-between gap-4 overflow-x-auto overflow-y-hidden whitespace-nowrap">

                <div class="flex items-center gap-2">
                    <form action="{{ route('keuangan.index') }}" method="GET" class="flex items-center gap-2">
                        <!-- Select per page -->
                        <div>
                            <x-select-input name="per_page" id="per_page" onchange="this.form.submit()">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </x-select-input>
                        </div>

                        <!-- Search input using Laravel Breeze component -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <x-text-input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari..." class="pl-10 w-60" />
                        </div>

                        <!-- Submit button -->
                        <x-btn-primary type="submit" class="md:hidden">
                            <i class="fi fi-rs-search relative top-0.5"></i>
                        </x-btn-primary>

                        {{-- Filter Data --}}
                        <div>
                            <x-select-input name="filter" id="filter" onchange="this.form.submit()">
                                <option value="" disabled>-- Filter Data --</option>
                                <option value="har_ini" {{ request('filter') == 'har_ini' ? 'selected' : '' }}>
                                    Hari ini
                                </option>
                                <option value="semua" {{ request('filter') == 'semua' ? 'selected' : '' }}>
                                    Semua
                                </option>
                            </x-select-input>
                        </div>
                    </form>
                </div>

                <!-- Button Tambah Proker -->
                <div class="flex gap-2">
                    <button data-modal-target="addModal"
                        class="flex items-center py-2.5 px-2 md:py-2 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors duration-300 rounded-md">
                        <i class="fi fi-rs-plus md:mr-2 leading-none relative top-0.5"></i>
                        <span class="hidden md:block">
                            Input Keuangan
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Proker-->
        <div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-60"></div>

            <div class="flex items-center justify-center min-h-screen p-4">
                <div id="modalContent"
                    class="relative bg-white rounded-lg shadow-xl w-full max-w-md md:max-w-xl lg:max-w-2xl mx-auto transition-all duration-300 transform">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900"> <i class="fi fi-rs-plus text-sm mr-2"></i>Input
                            Keuangan</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none"
                            data-modal-hide="addModal">
                            <i class="fi fi-rs-cross-small text-xl"></i>
                        </button>
                    </div>

                    <!-- Modal Body with Form -->
                    <form action="{{ route('keuangan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-4 space-y-4">
                            <!-- jenis_proker -->
                            <div>
                                <x-label for="jenis" required>Jenis Transaksi</x-label>
                                <x-select-input id="jenis" class="w-full" name="jenis">
                                    <option selected disabled>-- Pilih jenis transaksi --</option>
                                    <option value="pemasukan" {{ old('jenis') == 'pemasukan' ? 'selected' : '' }}>
                                        Pemasukan
                                    </option>
                                    <option value="pengeluaran" {{ old('jenis') == 'pengeluaran' ? 'selected' : '' }}>
                                        Pengeluaran
                                    </option>
                                </x-select-input>
                                <x-error-message for="jenis" />
                            </div>

                            <!-- tanggal -->
                            <div>
                                <x-label for="tanggal" required>Tanggal Transaksi</x-label>
                                <x-text-input class="w-full" id="tanggal" name="tanggal" type="date"
                                    placeholder="Tanggal Transaksi..."
                                    value="{{ old('tanggal', now()->format('Y-m-d')) }}" />
                                <x-error-message for="tanggal" />
                            </div>

                            <!-- Keterangan -->
                            <div>
                                <x-label for="keterangan" required>Keterangan</x-label>
                                <x-text-input class="w-full" id="keterangan" name="keterangan" type="text"
                                    placeholder="Keterangan Transaksi..." value="{{ old('keterangan') }}" />
                                <x-error-message for="keterangan" />
                            </div>

                            <!-- nominal -->
                            <div>
                                <x-label for="nominal" required>Nominal Transaksi</x-label>
                                <x-text-input class="w-full" id="nominal" name="nominal" type="number"
                                    placeholder="Nominal Transaksi..." value="{{ old('nominal') }}" />
                                <x-error-message for="nominal" />
                            </div>

                            <!-- metode_pembayaran -->
                            <div>
                                <x-label for="metode_pembayaran" required>Metode Pembayaran</x-label>
                                <x-select-input id="metode_pembayaran" class="w-full" name="metode_pembayaran">
                                    <option selected disabled>-- Pilih metode pembayaran --</option>
                                    <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>
                                        Cash
                                    </option>
                                    <option value="transfer"
                                        {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>
                                        Transfer
                                    </option>
                                </x-select-input>
                                <x-error-message for="metode_pembayaran" />
                            </div>

                            <!-- bukti_pembayaran -->
                            <div>
                                <x-label for="bukti_pembayaran">Bukti Transaksi</x-label>
                                <x-text-input class="w-full" id="bukti_pembayaran" name="bukti_pembayaran"
                                    type="file" accept="image/*,application/pdf" placeholder="Bukti Transaksi..."
                                    value="{{ old('bukti_pembayaran') }}" />
                                <x-error-message for="bukti_pembayaran" />
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="p-4 border-t flex justify-end space-x-3">
                            <x-btn-secondary type="button" data-modal-hide="addModal">
                                Batal
                            </x-btn-secondary>

                            <x-btn-primary type="submit">
                                Simpan
                            </x-btn-primary>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Table container -->
        <div class="p-4">
            <div class="overflow-x-auto rounded-md">
                <table class="min-w-full text-left text-gray-500">
                    <thead class="bg-gray-100 text-sm text-gray-700 uppercase">
                        <tr>
                            {{-- <th scope="col" class="px-2 pl-4 py-3 w-10"> <!-- Reduced padding and fixed width -->
                                <input type="checkbox"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </th> --}}
                            <th scope="col" class="px-2 py-3 w-12 text-center">No.</th>
                            {{-- <th scope="col" class="p-3">Jenis Transaksi</th> --}}
                            <th scope="col" class="p-3">Tanggal</th>
                            <th scope="col" class="p-3">Keterangan</th>
                            <th scope="col" class="p-3">Nominal</th>
                            <th scope="col" class="p-3">Metode Pembayaran</th>
                            <th scope="col" class="p-3">Bukti Pembayaran</th>
                            <th scope="col" class="p-3">Dibuat Oleh</th>
                            <th scope="col" class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($keuangan as $data)
                            @if ($data->jenis == 'pengeluaran')
                                <tr class="bg-red-50 text-gray-900 border-b">
                                @elseif ($data->jenis == 'pemasukan')
                                <tr class="bg-green-50 text-gray-900 border-b">
                            @endif
                            {{-- <td class="px-2 pl-4 py-3">
                                    <input type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </td> --}}
                            <td class="px-2 py-3 text-center">{{ ++$i }}</td>
                            <td class="p-3">
                                {{ optional($data->tanggal ? Carbon\Carbon::parse($data->tanggal) : null)->translatedFormat('l, d F Y') ?? '-' }}
                            </td>
                            <td class="p-3">{{ $data->keterangan }}</td>
                            <td class="p-3 text-end">Rp. {{ number_format($data->nominal, 0, ',', '.') }}</td>
                            <td class="p-3 text-center">
                                @if ($data->metode_pembayaran == 'cash')
                                    <span
                                        class="px-2.5 py-0.5 text-xs rounded-full bg-green-100 text-green-800">{{ ucfirst($data->metode_pembayaran) }}</span>
                                @elseif ($data->metode_pembayaran == 'transfer')
                                    <span
                                        class="px-2.5 py-0.5 text-xs rounded-full bg-blue-100 text-blue-800">{{ ucfirst($data->metode_pembayaran) }}</span>
                                @endif
                            </td>
                            <td class="p-3">
                                @if ($data->bukti_pembayaran)
                                    {{-- <a href="{{ asset('storage/' . $data->bukti_pembayaran) }}" target="_blank"> --}}
                                    <x-btn-primary data-modal-target="showModal{{ $data->id }}"><i
                                            class="fi fi-rs-receipt leading-none relative top-0.5"></i></x-btn-primary>
                                    {{-- </a> --}}
                                @elseif (!$data->bukti_pembayaran)
                                    -
                                @endif
                            </td>
                            <td class="p-3">
                                {{ $data->creator->name ?? '-' }}
                            </td>
                            <td class="p-3">
                                <div class="flex items-center gap-2">
                                    <x-btn-warning data-modal-target="editModal{{ $data->id }}"><i
                                            class="fi fi-rs-pencil leading-none relative top-0.5"></i></x-btn-warning>
                                    <x-btn-danger data-modal-target="deleteModal{{ $data->id }}"><i
                                            class="fi fi-rs-trash leading-none relative top-0.5"></i></x-btn-danger>
                                </div>
                            </td>
                            </tr>

                            <!-- Modal Show Bukti Pembayaran-->
                            <div id="showModal{{ $data->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                <!-- Backdrop -->
                                <div class="fixed inset-0 bg-black bg-opacity-60"></div>

                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <div id="modalContent"
                                        class="relative bg-white rounded-lg shadow-xl w-full max-w-sm md:max-w-xl lg:max-w-2xl mx-auto transition-all duration-300 transform">
                                        <!-- Modal Header -->
                                        <div class="flex justify-between items-center p-4 border-b">
                                            <h3 class="text-xl font-semibold text-gray-900"> <i
                                                    class="fi fi-rs-receipt text-sm mr-2"></i>Bukti
                                                Pembayaran</h3>
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                data-modal-hide="showModal{{ $data->id }}">
                                                <i class="fi fi-rs-cross-small text-xl"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Body with Form -->
                                        <div class="p-4 space-y-4">
                                            <img src="{{ asset('storage/' . $data->bukti_pembayaran) }}"
                                                alt="" class="mx-auto max-w-full h-auto">
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="p-4 border-t flex justify-end space-x-3">
                                            <x-btn-secondary type="button"
                                                data-modal-hide="showModal{{ $data->id }}">
                                                Tutup
                                            </x-btn-secondary>

                                            <a href="{{ asset('storage/' . $data->bukti_pembayaran) }}" download>
                                                <x-btn-danger type="button">
                                                    Download
                                                </x-btn-danger>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit User-->
                            <div id="editModal{{ $data->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                <!-- Backdrop -->
                                <div class="fixed inset-0 bg-black bg-opacity-60"></div>

                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <div id="modalContent"
                                        class="relative bg-white rounded-lg shadow-xl w-full max-w-md md:max-w-xl lg:max-w-2xl mx-auto transition-all duration-300 transform">
                                        <!-- Modal Header -->
                                        <div class="flex justify-between items-center p-4 border-b">
                                            <h3 class="text-xl font-semibold text-gray-900"> <i
                                                    class="fi fi-rs-pencil text-sm mr-2"></i>Edit
                                                Keuangan</h3>
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                data-modal-hide="editModal{{ $data->id }}">
                                                <i class="fi fi-rs-cross-small text-xl"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Body with Form -->
                                        <form action="{{ route('keuangan.update', $data->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="p-4 space-y-4">
                                                <!-- jenis_proker -->
                                                <div>
                                                    <x-label for="jenis" required>Jenis Transaksi</x-label>
                                                    <x-select-input id="jenis" class="w-full" name="jenis">
                                                        <option selected disabled>-- Pilih jenis transaksi --</option>
                                                        <option value="pemasukan"
                                                            {{ old('jenis') == 'pemasukan' || $data->jenis == 'pemasukan' ? 'selected' : '' }}>
                                                            Pemasukan
                                                        </option>
                                                        <option value="pengeluaran"
                                                            {{ old('jenis') == 'pengeluaran' || $data->jenis == 'pengeluaran' ? 'selected' : '' }}>
                                                            Pengeluaran
                                                        </option>
                                                    </x-select-input>
                                                    <x-error-message for="jenis" />
                                                </div>

                                                <!-- tanggal -->
                                                <div>
                                                    <x-label for="tanggal" required>Tanggal Transaksi</x-label>
                                                    <x-text-input class="w-full" id="tanggal" name="tanggal"
                                                        type="date" placeholder="Tanggal Transaksi..."
                                                        value="{{ old('tanggal', $data->tanggal) }}" />
                                                    <x-error-message for="tanggal" />
                                                </div>

                                                <!-- Keterangan -->
                                                <div>
                                                    <x-label for="keterangan" required>Keterangan</x-label>
                                                    <x-text-input class="w-full" id="keterangan" name="keterangan"
                                                        type="text" placeholder="Keterangan Transaksi..."
                                                        value="{{ old('keterangan', $data->keterangan) }}" />
                                                    <x-error-message for="keterangan" />
                                                </div>

                                                <!-- nominal -->
                                                <div>
                                                    <x-label for="nominal" required>Nominal Transaksi</x-label>
                                                    <x-text-input class="w-full" id="nominal" name="nominal"
                                                        type="number" placeholder="Nominal Transaksi..."
                                                        value="{{ old('nominal', number_format($data->nominal, 0, '.', '')) }}" />
                                                    <x-error-message for="nominal" />
                                                </div>

                                                <!-- metode_pembayaran -->
                                                <div>
                                                    <x-label for="metode_pembayaran" required>Metode
                                                        Pembayaran</x-label>
                                                    <x-select-input id="metode_pembayaran" class="w-full"
                                                        name="metode_pembayaran">
                                                        <option selected disabled>-- Pilih metode pembayaran --</option>
                                                        <option value="cash"
                                                            {{ old('metode_pembayaran') == 'cash' || $data->metode_pembayaran == 'cash' ? 'selected' : '' }}>
                                                            Cash
                                                        </option>
                                                        <option value="transfer"
                                                            {{ old('metode_pembayaran') == 'transfer' || $data->metode_pembayaran == 'transfer' ? 'selected' : '' }}>
                                                            Transfer
                                                        </option>
                                                    </x-select-input>
                                                    <x-error-message for="metode_pembayaran" />
                                                </div>

                                                <!-- bukti_pembayaran -->
                                                <div>
                                                    <x-label for="bukti_pembayaran">Bukti Transaksi</x-label>
                                                    <x-text-input class="w-full" id="bukti_pembayaran"
                                                        name="bukti_pembayaran" type="file"
                                                        accept="image/*,application/pdf"
                                                        placeholder="Bukti Transaksi..." />
                                                    <x-error-message for="bukti_pembayaran" />
                                                </div>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="p-4 border-t flex justify-end space-x-3">
                                                <x-btn-secondary type="button"
                                                    data-modal-hide="editModal{{ $data->id }}">
                                                    Batal
                                                </x-btn-secondary>

                                                <x-btn-primary type="submit">
                                                    Simpan
                                                </x-btn-primary>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Delete User-->
                            <div id="deleteModal{{ $data->id }}"
                                class="fixed inset-0 z-50 hidden overflow-y-auto">
                                <!-- Backdrop -->
                                <div class="fixed inset-0 bg-black bg-opacity-60"></div>

                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <div id="modalContent"
                                        class="relative bg-white rounded-lg shadow-xl w-full max-w-sm md:max-w-md lg:max-w-md mx-auto transition-all duration-300 transform">
                                        <!-- Modal Header -->
                                        <div class="flex justify-between items-center p-4 border-b">
                                            <h3 class="text-lg font-semibold text-gray-900"> <i
                                                    class="fi fi-rs-trash text-sm mr-2"></i>Delete Data
                                                Keuangan</h3>
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                data-modal-hide="deleteModal{{ $data->id }}">
                                                <i class="fi fi-rs-cross-small text-xl"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Body with Form -->
                                        <form action="{{ route('keuangan.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="p-4 space-y-4">
                                                <p class="text-center text-gray-900">
                                                    Apakah anda yakin ingin menghapus data nominal
                                                    <b>'Rp. {{ number_format($data->nominal, 0, ',', '.') }}'</b>
                                                    ini?
                                                </p>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="p-4 border-t flex justify-end space-x-3">
                                                <x-btn-secondary type="button"
                                                    data-modal-hide="deleteModal{{ $data->id }}">
                                                    Batal
                                                </x-btn-secondary>

                                                <x-btn-danger type="submit">
                                                    Hapus
                                                </x-btn-danger>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center p-5">Belum ada data transaksi hari ini.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination would go here -->
        <div class="p-4 border-t border-gray-200">
            {{ $keuangan->links() }}
        </div>
    </div>



</x-app-layout>
