@if ($paginator->hasPages())
<nav class="fluent-pagination" aria-label="{{ __('pagination.pagination') }}">
    <div class="fluent-pagination-inner">
        <div class="fluent-pagination-info">
            <span class="fluent-pagination-info-text">
                {!! __('Showing') !!}
                <strong>{{ $paginator->firstItem() ?? 0 }}</strong>
                {!! __('to') !!}
                <strong>{{ $paginator->lastItem() ?? 0 }}</strong>
                {!! __('of') !!}
                <strong>{{ $paginator->total() }}</strong>
                {!! __('results') !!}
            </span>
        </div>
        <ul class="fluent-pagination-list" role="navigation">
            @if ($paginator->onFirstPage())
                <li class="fluent-pagination-item fluent-pagination-item--disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="fluent-pagination-link fluent-pagination-link--icon" aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                </li>
            @else
                <li class="fluent-pagination-item">
                    <a class="fluent-pagination-link fluent-pagination-link--icon" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="bi bi-chevron-left"></i></a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="fluent-pagination-item fluent-pagination-item--gap" aria-hidden="true"><span class="fluent-pagination-link">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="fluent-pagination-item fluent-pagination-item--active" aria-current="page">
                                <span class="fluent-pagination-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="fluent-pagination-item">
                                <a class="fluent-pagination-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="fluent-pagination-item">
                    <a class="fluent-pagination-link fluent-pagination-link--icon" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="bi bi-chevron-right"></i></a>
                </li>
            @else
                <li class="fluent-pagination-item fluent-pagination-item--disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="fluent-pagination-link fluent-pagination-link--icon" aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </div>
</nav>
@endif
