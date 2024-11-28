<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-6">Edit Produk</h2>
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Grid Layout -->
                    <div class="grid grid-cols-3 gap-6 mb-6">
                        <!-- Kategori -->
                        <div class="col-span-1">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select id="category_id" name="category_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled>Pilih Kategori</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nama Barang -->
                        <div class="col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Masukan nama barang"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <!-- Harga Beli -->
                        <div class="col-span-1">
                            <label for="purchase_price" class="block text-sm font-medium text-gray-700">Harga Beli</label>
                            <input type="text" id="harga_beli" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" placeholder="Masukan Harga Beli"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('purchase_price')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Harga Jual -->
                        <div class="col-span-1">
                            <label for="sale_price" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                            <input type="text" id="harga_jual" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" placeholder="Masukan Harga Jual"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('sale_price')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Stok Barang -->
                        <div class="col-span-1">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stok Barang</label>
                            <input type="text" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="Masukan jumlah stok barang"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('stock')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Upload Gambar -->
                        <div class="col-span-3">
                            <label class="block text-sm font-medium text-gray-700">Upload Gambar</label>
                            <div class="mt-2 flex justify-center border-2 border-dashed border-blue-300 rounded-lg px-6 pt-5 pb-6">
                                <div class="space-y-1 text-center">
                                    @if($product->image)
                                    <img id="preview-image" src="{{ asset($product->image) }}" alt="Product Image" class="mx-auto h-32 w-32 object-cover">
                                    @else
                                    <img id="preview-image" src="{{ asset('assets/Image.png') }}" alt="Default Image" class="mx-auto h-12 w-12">
                                    @endif
                                    <div class="text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Upload gambar di sini</span>
                                            <input id="image" name="image" type="file" class="sr-only" onchange="previewImage(event)">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('products.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Batalkan</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const image = document.getElementById('image').files[0];
            const preview = document.getElementById('preview-image');
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result; // Set image preview source
                preview.classList.add('h-32', 'w-32', 'object-cover'); // Optional: adjust preview styling
            };

            if (image) {
                reader.readAsDataURL(image); // Read image file as base64
            }
        }
    </script>
</x-app-layout>