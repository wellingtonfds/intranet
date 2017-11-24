@if ($paginator->hasPages())
    <div class="w3-center">
        <div class="w3-bar">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a href="" class="w3-button w3-bar-item">&laquo;</a>
                {{--<li class="disabled"><span>&laquo;</span></li>--}}
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="w3-button" rel="prev">&laquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="" class="w3-button w3-border">{{ $page }}</a>
                        @else
                            <a class="w3-button" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="w3-button" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
            @else
                <a href="" class="w3-button">&raquo;</a>
            @endif
        </div>
    </div>
@endif
