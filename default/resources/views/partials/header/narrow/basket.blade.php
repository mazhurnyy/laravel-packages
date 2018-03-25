{{-- Ссылка на корзину в узкой верхней полосе --}}

@inject('basket', 'App\Services\Basket')

@php
    $hidden = empty($basket->getCountPositions()) ? ' hidden' : '';
@endphp

<li>
    <a href="{{route('basket')}}">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i> @lang('meta.basket')
        <span class="basket_brace{{ $hidden }}">(</span><span class="basket_number{{ $hidden }}">{{
        $basket->getCountPositions()
        }}</span><span class="basket_brace{{ $hidden }}">)</span>
    </a>
</li>