{{-- Универсальный каталог --}}

@isset($catalog)
    @include('partials.catalog.filters')

    @if (count($catalog['results']) > 0)

        @include('partials.catalog.cards')
        @include('partials.catalog.more')

    @elseif (!empty(Filters::getFilters()))

        <div class="alert alert-danger" role="alert">
            @lang('status.sample_null')
        </div>

    @endif
@endisset