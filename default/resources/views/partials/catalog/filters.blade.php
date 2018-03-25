{{-- Фильтры и сортировка каталога; информация каталога: всего, выбрано --}}

@if (empty(Filters::getFilters()))
    <div id="all" class="hidden" data-page="1">{{ $catalog['selected'] }}</div>
@else

    @foreach(Filters::getFilters() as $filter)
        @include('partials.catalog.dropdown')
    @endforeach

    <div class="d_ib mb_half">
        <strong>@lang('headers.all'):</strong>
        <div class="d_ib filter_item">
            @if ($catalog['amount'] > $catalog['selected'])
                <a href="{{ Filters::getSectionUrl() }}">{{ $catalog['amount'] }}</a>
            @else
                {{ $catalog['amount'] }}
            @endif
        </div>
    </div>

    <div class="d_ib mb_half">
        <strong>@lang('headers.selected'):</strong>
        <div class="d_ib filter_item">
            <span id="all" data-page="1">{{ $catalog['selected'] }}</span>
        </div>
    </div>

    <div class="paragraph_fix"></div>

@endif