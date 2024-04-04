@vite('resources/css/pagination.css')

@if ($paginator->hasPages())
    <nav role= aria-label="{{ __('Pagination Navigation') }}"">
        <div>
            <div class="pag-font">
                <span>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span class="ecart-r no_under" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span aria-hidden="true">
                            <i class="pag-el fa-solid fa-arrow-left"></i>
                            </span>
                        </span>
                    @else
                        <a class="ecart-r no_under" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}">
                            <i class="pag-el fa-solid fa-arrow-left"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span class="pag-el ecart-l no_under" aria-disabled="true">
                                <span>{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span  class="ecart-b pag-el" aria-current="page">
                                        <span class="select">{{ $page }}</span>
                                    </span>
                                @else
                                    <a class="ecart-b pag-el no_under" href="{{ $url }}" >
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a class="pag-el ecart-l no_under" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}">
                        <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @else
                        <span class="pag-el no_under" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="pag-el ecart-l no_under" aria-hidden="true">
                            <i class="pag-el fa-solid fa-arrow-right"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif