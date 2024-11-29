<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <img src="{{ asset('assets/profile.png') }}" alt="profile" class="mb-3 w-45 h-auto rounded-full">
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div class="col-span-2">
                        <label for="purchase_price" class="block text-sm font-medium text-gray-700">Nama Kandidat</label>
                        <input type="text" value="@ Eko Nur Jaelani" disabled
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="col-span-1">
                        <label for="sale_price" class="block text-sm font-medium text-gray-700">Posisi Kandidat</label>
                        <input type="text" value="</> Web Programmer" disabled
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>