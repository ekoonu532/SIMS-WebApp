<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcumb
                :values="[__('Daftar Produk'), __('Edit Produk')]"
                :routes="[
        route('products.index'),
        route('products.edit', $product->id)
    ]">
            </x-breadcumb>

            <div class="p-8 rounded-lg">
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
                            <div
                                id="drop-area"
                                class="mt-2 flex flex-col justify-center items-center border-2 border-dashed border-blue-300 rounded-lg px-6 pt-5 pb-6"
                                ondragover="handleDragOver(event)"
                                ondrop="handleDrop(event)">
                                <div class="space-y-1 text-center">
                                    <img
                                        id="preview-image"
                                        src="{{ $product->image ? asset($product->image) : asset('assets/Image.png') }}"
                                        alt="Product Image"
                                        class="mx-auto {{ $product->image ? 'h-32 w-32 object-cover' : 'h-12 w-12' }}">
                                    <div class="text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span id="file-name">{{ $product->image ? basename($product->image) : 'Upload gambar di sini' }}</span>
                                            <input
                                                id="image"
                                                name="image"
                                                type="file"
                                                class="sr-only"
                                                onchange="handleFileChange(event)">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('products.index') }}" class="px-6 py-2 bg-white border border-blue-600 text-blue-600 rounded-md hover:bg-blue-600 hover:text-white">Batalkan</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const hargaBeliInput = document.getElementById('harga_beli');
        const hargaJualInput = document.getElementById('harga_jual');

        hargaBeliInput.addEventListener('input', () => {
            const hargaBeli = parseFloat(hargaBeliInput.value);

            if (!isNaN(hargaBeli) && hargaBeli >= 0) {

                const hargaJual = hargaBeli * 1.3;

                hargaJualInput.value = Math.round(hargaJual);
            } else {
                hargaJualInput.value = '';
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const hargaBeliInput = document.getElementById('harga_beli');
            if (hargaBeliInput) {
                hargaBeliInput.value = parseInt(hargaBeliInput.value);
            }

            const hargaJualInput = document.getElementById('harga_jual');
            if (hargaJualInput) {
                hargaJualInput.value = parseInt(hargaJualInput.value);
            }
        });

        function previewImage(file) {
            const preview = document.getElementById('preview-image');
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result; 
                preview.classList.add('h-32', 'w-32', 'object-cover');
            };

            if (file) {
                reader.readAsDataURL(file); 
            }
        }

        function handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById('file-name').textContent = file.name; 
                previewImage(file); 
            }
        }

        function handleDragOver(event) {
            event.preventDefault();
            event.stopPropagation();
            const dropArea = document.getElementById('drop-area');
            dropArea.classList.add('border-blue-500'); 
        }

        function handleDrop(event) {
            event.preventDefault();
            event.stopPropagation();
            const dropArea = document.getElementById('drop-area');
            dropArea.classList.remove('border-blue-500'); 
            const file = event.dataTransfer.files[0]; 
            if (file) {
                document.getElementById('image').files = event.dataTransfer.files; 
                document.getElementById('file-name').textContent = file.name; 
                previewImage(file); 
            }
        }
    </script>

</x-app-layout>