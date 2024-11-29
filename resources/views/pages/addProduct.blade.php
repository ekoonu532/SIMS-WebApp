<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcumb
                :values="[__('Daftar Produk'), __('Tambah Produk')]"
                :routes="[
        route('products.index'),
        route('products.create')
    ]"></x-breadcumb>

            <div class="p-8 rounded-lg ">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Grid Layout -->
                    <div class="grid grid-cols-3 gap-6 mb-6">
                        <!-- Kategori -->
                        <div class="col-span-1">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select id="category_id" name="category_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih Kategori</option>
                                @foreach($category as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nama Barang -->
                        <div class="col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukan nama barang"
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
                            <input type="text" id="harga_beli" name="purchase_price" value="{{ old('purchase_price') }}" placeholder="Masukan Harga Beli"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('purchase_price')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Harga Jual -->
                        <div class="col-span-1">
                            <label for="sale_price" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                            <input type="text" id="harga_jual" name="sale_price" value="{{ old('sale_price') }}" placeholder="Masukan Harga Jual"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('sale_price')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Stok Barang -->
                        <div class="col-span-1">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stok Barang</label>
                            <input type="text" id="stock" name="stock" value="{{ old('stock') }}" placeholder="Masukan jumlah stok barang"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('stock')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Upload Gambar -->
                        <div class="col-span-3">
                            <label class="block text-sm font-medium text-gray-700">Upload Gambar</label>
                            <div id="dropzone" class="mt-2 flex justify-center border-2 border-dashed border-blue-300 rounded-lg px-6 pt-5 pb-6">
                                <div class="space-y-1 text-center">
                                    <img id="preview-image" src="{{ asset('assets/Image.png') }}" alt="Upload Icon" class="mx-auto h-12 w-12">
                                    <div class="text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span id="dropzone-label">Upload gambar di sini</span>
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

        function previewImage(event) {
            const image = event.target.files[0];
            const preview = document.getElementById('preview-image');
            const labelText = document.getElementById('dropzone-label'); 
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.add('h-32', 'w-32', 'object-cover');
            };

            if (image) {
                reader.readAsDataURL(image);
                labelText.textContent = image.name; 
            }
        }

        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('image');
        const preview = document.getElementById('preview-image');
        const labelText = document.getElementById('dropzone-label'); 
        function handleDrop(event) {
            event.preventDefault();
            const file = event.dataTransfer.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.add('h-32', 'w-32', 'object-cover');
            };

            if (file) {
                reader.readAsDataURL(file);
                labelText.textContent = file.name; 
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
            }
        }

        dropzone.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropzone.classList.add('border-blue-500');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-blue-500');
        });

        dropzone.addEventListener('drop', handleDrop);
    </script>
</x-app-layout>