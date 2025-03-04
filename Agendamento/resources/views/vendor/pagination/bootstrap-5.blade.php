@if ($paginator->hasPages())
    <head>
        <link rel="stylesheet" href="{{ asset('CSS/estilos-paginacao.css') }}" />
    </head>
    <nav class="nav-paginacao">
        <div>
            <ul>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li aria-disabled="true">
                        Anterior
                    </li>
                @else
                    <li>
                        <div>
                            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">Anterior</a>
                        </div>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li aria-disabled="true">{{ $element }}</li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li aria-current="page">{{ $page }}</li>
                            @else
                                <li>
                                    <div>
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <div>
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next">Próximo</a>
                        </div>
                    </li>
                @else
                    <li aria-disabled="true">
                        Próximo
                    </li>
                @endif
            </ul>
        </div>

        <div>
            <div>
                <p>
                    {!! __('Mostrando') !!}
                    {{ $paginator->firstItem() }}
                    {!! __('a') !!}
                    {{ $paginator->lastItem() }}
                    {!! __('de') !!}
                    {{ $paginator->total() }}
                    {!! __('resultados') !!}
                </p>
            </div>

            </div>
        </div>
    </nav>
@endif
