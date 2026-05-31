<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Barang') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-[calc(100vh-65px)]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-sm border border-gray-100 sm:rounded-2xl">
                <div class="p-8">
                    <form action="{{ route('products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Product Name Field -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" placeholder="Masukkan nama barang" class="w-full px-4 py-3 rounded-xl border @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-gray-200 focus:border-indigo-500 focus:ring-indigo-200 @enderror focus:ring-4 transition duration-200" required autofocus>
                            @error('name')
                                <p class="mt-2 text-sm text-rose-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category Dropdown Field -->
                        <div class="mb-6">
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <select name="category_id" id="category_id" class="w-full px-4 py-3 rounded-xl border @error('category_id') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-gray-200 focus:border-indigo-500 focus:ring-indigo-200 @enderror focus:ring-4 transition duration-200" required>
                                <option value="" disabled>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-rose-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Price Field -->
                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rupiah)</label>
                                <div class="relative rounded-xl shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="price" id="price" min="0" step="any" value="{{ old('price', (int)$product->price) }}" placeholder="0" class="w-full pl-10 pr-4 py-3 rounded-xl border @error('price') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-gray-200 focus:border-indigo-500 focus:ring-indigo-200 @enderror focus:ring-4 transition duration-200" required>
                                </div>
                                @error('price')
                                    <p class="mt-2 text-sm text-rose-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Stock Field -->
                            <div>
                                <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                                <input type="number" name="stock" id="stock" min="0" value="{{ old('stock', $product->stock) }}" placeholder="0" class="w-full px-4 py-3 rounded-xl border @error('stock') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-gray-200 focus:border-indigo-500 focus:ring-indigo-200 @enderror focus:ring-4 transition duration-200" required>
                                @error('stock')
                                    <p class="mt-2 text-sm text-rose-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-600 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-100 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-100 transition duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
