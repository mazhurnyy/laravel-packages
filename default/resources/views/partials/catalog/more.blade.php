{{-- Кнопка показать ещё --}}

@if ($catalog['selected'] <> count($catalog['results']))
    <div class="text-center">
        <i id="catalog_more_load" class="fa fa-spinner fa-pulse fa-2x hidden mb_base" aria-hidden="true"></i>
    </div>
@endif