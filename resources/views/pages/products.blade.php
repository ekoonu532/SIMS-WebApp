<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcumb :values="[__('Daftar Produk')]"></x-breadcumb>
            <div class="flex justify-between items-center mb-2">
                <form id="filterForm" method="GET" action="{{ route('products.index') }}">
                    <div class="flex items-center mb-3">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Cari barang..."
                            class="rounded-lg p-2 me-2">

                        <select name="filter" id="filter"
                            class="rounded-lg px-8 py-2 me-4">
                            <option value="Semua" {{ request('filter') === 'Semua' ? 'selected' : '' }}>Semua</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('filter') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="flex items-center mb-2">
                    <a href="{{ route('products.export', ['search' => request('search'), 'filter' => request('filter')]) }}" class=" flex items-center space-x-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"><img src="{{ asset('assets/MicrosoftExcelLogo.png') }}" alt="export excel" class="w-5 h-5"> <span>Export Excel</span></a>
                    <a href="{{ route('products.create') }}"
                        class="flex items-center space-x-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        <img src="{{ asset('assets/PlusCircle.png') }}" alt="tambah produk" class="w-5 h-5">
                        <span>Tambah Produk</span>
                    </a>
                </div>

            </div>

            <div class="relative overflow-x-auto max-w-7xl align-items-center">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Produk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kategori Produk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga Beli (Rp)
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga Jual (Rp)
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stok Produk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $prod)
                        <tr class="bg-white hover:bg-gray-50">
                            <!-- Nomor -->
                            <td class="px-4 py-2 text-center text-gray-900">{{ $loop->iteration }}</td>

                            <!-- Gambar Produk -->
                            <td class="px-4 py-2 text-center">
                                <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" class="w-12 h-12 object-cover mx-auto">
                            </td>

                            <!-- Nama Produk -->
                            <td class="px-4 py-2 text-gray-900">
                                {{ $prod->name }}
                            </td>

                            <!-- Kategori -->
                            <td class="px-4 py-2 text-gray-900">
                                {{ $prod->category_name }}
                            </td>

                            <!-- Harga Beli -->
                            <td class="px-4 py-2 text-right text-gray-900">
                                {{ number_format($prod->purchase_price, 0, ',', '.') }}
                            </td>

                            <!-- Harga Jual -->
                            <td class="px-4 py-2 text-right text-gray-900">
                                {{ number_format($prod->sale_price, 0, ',', '.') }}
                            </td>

                            <!-- Stok -->
                            <td class="px-4 py-2 text-center text-gray-900">
                                {{ $prod->stock }}
                            </td>

                            <!-- Aksi -->
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('products.edit', $prod->id) }}" class="hover:opacity-80">
                                        <img src="{{ asset('assets/edit.png') }}" alt="Edit" class="w-5 h-5">
                                    </a>
                                    <form action="{{ route('products.destroy', $prod->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hover:opacity-80">
                                            <img src="{{ asset('assets/delete.png') }}" alt="Delete" class="w-5 h-5">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="max-w-full px-4 py-2 text-center">
                    <td>
                        {{ $products->links() }}
                    </td>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const filterDropdown = document.getElementById('filter');
            const filterForm = document.getElementById('filterForm');

            filterDropdown.addEventListener('change', function() {
                filterForm.submit();
            });

            let timeout = null;
            searchInput.addEventListener('input', function() {
                clearTimeout(timeout); 
                timeout = setTimeout(() => {
                    filterForm.submit();
                }, 1000);
            });
        });
    </script>




</x-app-layout>