<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">

            <i class="fi fi-rs-messages text-2xl leading-none relative"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Kotak Pesan</h2>
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

        {{-- card pesan --}}
        @forelse ($pesan as $item)
            <div class="p-4 border-b border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $item->email }} <span
                                class="text-xs text-gray-400">{{ $item->ip_address }}</span></p>
                        <p class="mt-2 text-gray-700">{{ $item->message }}</p>
                    </div>
                    <div class="text-right ml-4 flex flex-col items-end">
                        <span class="text-sm text-gray-400 mb-2">
                            {{ $item->created_at->diffForHumans() }}
                        </span>
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'ketua' || Auth::user()->role == 'wakil')
                            <form action="{{ route('kotak-pesan.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus pesan ini?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="p-4 text-gray-500 text-sm">
                Belum ada pesan masuk.
            </div>
        @endforelse

        <!-- Pagination -->
        <div class="p-4 border-t border-gray-200">
            {{ $pesan->links() }}
        </div>
    </div>




</x-app-layout>
