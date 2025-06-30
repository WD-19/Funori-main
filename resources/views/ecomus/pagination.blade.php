@if ($paginator->hasPages())
    <ul class="pagination ecomus-pagination" style="display: flex; gap: 6px; list-style: none; padding: 0; margin: 0;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" style="opacity: 0.5;"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="text-decoration:none;">&laquo;</a></li>
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
                        <li class="active" style="font-weight:bold; color:#fcad02;"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" style="text-decoration:none; color:#222;">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" style="text-decoration:none;">&raquo;</a></li>
        @else
            <li class="disabled" style="opacity: 0.5;"><span>&raquo;</span></li>
        @endif
    </ul>
@endif