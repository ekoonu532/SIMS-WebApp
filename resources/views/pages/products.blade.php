<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcumb :values="[__('Daftar Produk')]"></x-breadcumb>
            <div class="flex justify-between items-center mb-2">
                <form id="filterForm" method="GET" action="{{ route('products.index') }}">
                    <div class="flex items-center mb-3">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Cari barang..."
                            class="rounded-lg me-2">

                        <select name="filter" id="filter" class="rounded-lg max-w-2xl me-4 text-left">
                            <option value="Semua" {{ request('filter', 'Semua') === 'Semua' ? 'selected' : '' }}>Semua</option>
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
                <div x-data="{ open: false, deleteUrl: '' }">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-gray-300">
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
                                <td class="px-4 py-2 text-center text-gray-900">{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" class="w-12 h-12 object-cover mx-auto">
                                </td>
                                <td class="px-4 py-2 text-gray-900">
                                    {{ $prod->name }}
                                </td>
                                <td class="px-4 py-2 text-gray-900">
                                    {{ $prod->category_name }}
                                </td>
                                <td class="px-4 py-2 text-right text-gray-900">
                                    {{ number_format($prod->purchase_price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-right text-gray-900">
                                    {{ number_format($prod->sale_price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-center text-gray-900">
                                    {{ $prod->stock }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('products.edit', $prod->id) }}" class="hover:opacity-80">
                                            <img src="{{ asset('assets/edit.png') }}" alt="Edit" class="w-5 h-5">
                                        </a>
                                        <button @click="open = true; deleteUrl = '{{ route('products.destroy', $prod->id) }}'" class="hover:opacity-80">
                                            <img src="{{ asset('assets/delete.png') }}" alt="Delete" class="w-5 h-5">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                        <div class="bg-white p-6 rounded shadow-lg w-1/3">
                            <h2 class="text-lg font-bold">Konfirmasi Penghapusan</h2>
                            <p class="mt-4">Apakah Anda yakin ingin menghapus produk ini?</p>
                            <div class="flex justify-end mt-6">
                                <button @click="open = false" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                                <form :action="deleteUrl" method="POST" class="ml-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-full px-4 py-2 text-center">
                    <td>
                        {{ $products->appends(request()->query())->links() }}
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