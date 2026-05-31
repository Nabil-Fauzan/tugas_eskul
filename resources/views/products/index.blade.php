<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Daftar Barang') }}
            </h2>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Barang
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-[calc(100vh-65px)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Message -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg flex items-center shadow-sm animate-fade-in">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-sm border border-gray-100 sm:rounded-2xl">
                <div class="p-6">
                    <!-- Search & Filter Form -->
                    <form action="{{ route('products.index') }}" method="GET" class="mb-6 bg-gray-50/50 p-4 rounded-xl border border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <!-- Search Input -->
                            <div class="flex-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang berdasarkan nama..." class="w-full pl-10 pr-4 py-2 text-sm border-gray-200 focus:border-indigo-500 focus:ring-indigo-200 rounded-lg transition duration-200 focus:ring-4">
                            </div>

                            <!-- Category Filter Dropdown -->
                            <div class="w-full md:w-48">
                                <select name="category_id" class="w-full py-2 text-sm border-gray-200 focus:border-indigo-500 focus:ring-indigo-200 rounded-lg transition duration-200 focus:ring-4">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center space-x-2">
                                <button type="submit" class="w-full md:w-auto px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold shadow transition duration-150 ease-in-out">
                                    Cari
                                </button>
                                @if (request()->filled('search') || request()->filled('category_id'))
                                    <a href="{{ route('products.index') }}" class="w-full md:w-auto px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold text-center transition duration-150 ease-in-out">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    @if ($products->isEmpty())
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            @if (request()->filled('search') || request()->filled('category_id'))
                                <h3 class="text-lg font-medium text-gray-900 mb-1">Hasil pencarian tidak ditemukan</h3>
                                <p class="text-gray-500 mb-6 font-semibold">Tidak ada barang yang cocok dengan kata kunci atau filter pencarian Anda.</p>
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold transition ease-in-out duration-150">
                                    Bersihkan Pencarian
                                </a>
                            @else
                                <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada barang</h3>
                                <p class="text-gray-500 mb-6">Mulai dengan menambahkan barang baru ke dalam sistem.</p>
                                <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                                    Tambah Barang
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="overflow-x-auto rounded-xl border border-gray-100">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead class="bg-gray-50/75">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-16">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Nama Barang
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Kategori
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Harga
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Stok
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider w-40">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-50">
                                    @foreach ($products as $index => $product)
                                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-800">
                                                    {{ $product->category->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($product->stock == 0)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-100">
                                                        Habis
                                                    </span>
                                                @elseif ($product->stock <= 5)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-100">
                                                        {{ $product->stock }} (Menipis)
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-100">
                                                        {{ $product->stock }} (Tersedia)
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center p-2 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded-lg transition-colors duration-150" title="Edit">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                    </a>
                                                    
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center p-2 text-rose-600 hover:text-rose-900 hover:bg-rose-50 rounded-lg transition-colors duration-150" title="Hapus">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
