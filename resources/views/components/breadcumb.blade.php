<div class="mb-0">
    @if(count($values))
        <div class="flex flex-col sm:flex-row justify-between">
            <h1 class="font-bold text-2xl py-2 mb-2">
                @foreach($values as $key => $value)
                    @if($loop->last)
                        {{-- Elemen terakhir (aktif) --}}
                        <span class="text-gray-900 font-semibold">{{ $value }}</span>
                    @else
                        {{-- Elemen sebelumnya (lebih light) --}}
                        <a href="{{ $routes[$key] ?? '#' }}" 
                            class="text-gray-500 hover:text-gray-900">
                            {{ $value }}
                        </a>
                        <span class="mx-2">></span>
                    @endif
                @endforeach
            </h1>
            <div class="py-3">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>
