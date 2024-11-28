<aside class="bg-red-500 w-64 border-r min-h-screen border-gray-200 overflow-y-auto">
    <div class="h-full flex flex-col">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 ">
            <a href="{{ route('products.index') }}" class="flex p-6">
                <img src="{{ asset('assets/Handbag.png') }}" alt="" class="block h-5 w-auto fill-current " /> <span class="ml-3 text-white font-semibold">SIMS Web App</span>
            </a>
            <button
                id="closeSidebarBtn"
                class="text-white text-2xl hover:text-gray-300 focus:outline-none"
            >
                &times;
            </button>
        </div>

        <ul class="mt-20">
            <li class="group">
                <a href="{{ route('products.index') }}"
                    class="p-6 flex items-center h-12 w-full text-sm font-medium text-white bg-red-500 hover:bg-red-600
    {{ Route::is('products.index', 'products.create', 'products.edit') ? 'bg-red-700' : '' }}">
                    <img src="{{ asset('assets/Package.png') }}" alt="">
                    <span class="ml-3 font-semibold text-xl">{{ __('Produk') }}</span>
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="p-6 flex items-center h-12 w-full text-sm font-medium text-white bg-red-500 hover:bg-red-600 {{ \Illuminate\Support\Facades\Route::is('profile.edit') ? 'bg-red-700' : '' }}">
                    <img src="{{ asset('assets/User.png') }}" alt="">
                    <span class="ml-3 font-semibold text-xl">{{ __('Profile') }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button href="{{ route('logout') }}"
                        class="p-6 flex items-center h-12 w-full text-sm font-medium text-white bg-red-500 hover:bg-red-600 {{ \Illuminate\Support\Facades\Route::is('logout') ? 'bg-red-700' : '' }}">
                        <img src="{{ asset('assets/SignOut.png') }}" alt="">
                        <span class="ml-3 font-semibold text-xl">{{ __('Logout') }}</span>
                    </button>
                </form>
            </li>
        </ul>


    </div>
</aside>