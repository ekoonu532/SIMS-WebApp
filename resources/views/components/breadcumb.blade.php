<div class=" mb-0">
    @if(count($values))
        <div class="d-flex justify-content-between flex-column flex-sm-row ">
            <h1 class="font-bold text-2xl py-2 mb-2">
                @foreach($values as $value)
                    @if($loop->last)
                        {{ $value }}
                    @else
                        <span class="text-muted fw-light">{{ $value }} ></span>
                    @endif
                @endforeach
            </h1>
            <div class="py-3">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>

