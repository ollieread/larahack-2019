<div class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="disabled" aria-disabled="true">@lang('pagination.previous')</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
    @else
        <span class="disabled" aria-disabled="true">@lang('pagination.next')</span>
    @endif
</div>
