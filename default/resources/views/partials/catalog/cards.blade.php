{{-- Карточки универсального каталога --}}

<div class="row mb_base" id="catalog">
    @foreach ($catalog['results'] as $item)
        @include('partials.catalog.cards.' . $catalog['type'])
    @endforeach
</div>