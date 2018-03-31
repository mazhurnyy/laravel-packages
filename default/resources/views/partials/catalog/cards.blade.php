{{-- Карточки универсального каталога --}}

@foreach ($catalog['results'] as $item)
    @include('partials.catalog.cards.' . $catalog['type'])
@endforeach