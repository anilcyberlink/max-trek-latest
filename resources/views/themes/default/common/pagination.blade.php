@if ($paginator->hasPages())
    <div class="uk-flex uk-flex-center uk-margin-large-top">
        <nav aria-label="Pagination">
            <ul class="uk-pagination" uk-margin>

                {{-- Previous Page --}}
                @if ($paginator->onFirstPage())
                    <li class="uk-disabled"><span><span uk-pagination-previous ></span></span></li>
                @else
                    <li><a href="{{ $paginator->previousPageUrl() }}"><span uk-pagination-previous class="prev arrow-prev"></span></a></li>
                @endif

                {{-- Page Numbers --}}
                @foreach ($paginator->links()->elements[0] ?? [] as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="uk-active"><span aria-current="page">{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}"><span uk-pagination-next class="next arrow-next"></span></a></li>
                @else
                    <li class="uk-disabled"><span><span uk-pagination-next ></span></span></li>
                @endif

            </ul>
        </nav>
    </div>
@endif
