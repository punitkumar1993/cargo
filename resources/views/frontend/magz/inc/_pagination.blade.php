@if ($paginator->hasPages())
<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="prev disabled">
            <a href="#">
                <i class="ion-ios-arrow-left"></i>
            </a>
        </li>    
    @else
        <li class="prev">
            <a href="{{ $paginator->previousPageUrl() }}">
                <i class="ion-ios-arrow-left"></i>
            </a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled"><a href="#">{{ $element }}</a></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active"><a href="#">{{ $page }}</a></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="next">
            <a href="{{ $paginator->nextPageUrl() }}">
                <i class="ion-ios-arrow-right"></i>
            </a>
        </li>
    @else
        <li class="next disabled">
            <a href="#">
                <i class="ion-ios-arrow-right"></i></li>
            </a>
    @endif
</ul>
<div class="pagination-help-text">
    Showing {{ $paginator->count() }} results of {{ $paginator->total() }} &mdash; Page {{ $paginator->currentPage() }}
</div>
@endif