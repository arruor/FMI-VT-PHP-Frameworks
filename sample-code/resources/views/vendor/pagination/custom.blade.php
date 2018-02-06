<div class="collapse navbar-collapse">
    @if (!$paginator->onFirstPage())
    <a class="nav-link first-page" href="{{ $paginator->url(1) }}">Първа</a>
    <a class="nav-link prev-page" href="{{ $paginator->previousPageUrl() }}">Предходна</a>
    @endif

    Страница
    <input class="current-page" value="{{ $paginator->currentPage() }}">
    от {{ $paginator->lastPage() }}

    @if ($paginator->currentPage() < $paginator->lastPage())
    <a class="nav-link next-page" href="{{ $paginator->nextPageUrl() }}">Следваща</a>
    <a class="nav-link last-page" href="{{ $paginator->url($paginator->lastPage()) }}">Последна</a>
    @endif

    <span class="result-items">
        Резултати {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} от {{ $paginator->total() }}
    </span>
</div>
