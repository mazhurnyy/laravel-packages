{{-- Карточка товаров --}}

@inject('src', 'Mazhurnyy\Services\Blade\SrcFiles')

<div class="col-sm-6 col-md-4 i">
    <div class="card">
        
        @if (!empty($src->sm($item)))
            <div class="card_img">
                <a href="{{ route('product', ['alias' => $item->alias]) }}" title="{{ $item->title }}">
                    <img src="{{ $src->sm($item) }}"
                         alt="{{ $item->title }}"
                         class="img-responsive"
                    />
                </a>
            </div>
        @endif
        
        <div class="h2">
            <a href="{{ route('product', ['alias' => $item->alias]) }}">
                {{ $item->title }} ({{ $item->article }})
            </a>
        </div>
        
        <div class="row">
            <div class="col-xs-5 card_product_status">
                
                {{ $item->status->title }}
            
            </div>
            <div class="col-xs-4 card_product_price">
                {{-- todo валюты в свою локаль бы надо --}}
                <strong>{{ $item->unit_price }}</strong>&nbsp;@lang('headers.product.grn')
               
            </div>
            <div class="col-xs-3">
                
                @include('section.basket.position.add', ['id' => $item->id])
            
            </div>
        </div>
    
    </div>
</div>

@if ($loop->index % 6 == 5)
    <div class="clearfix"></div>
@elseif ($loop->index % 3 == 2)
    <div class="clearfix visible-md-block visible-lg-block"></div>
@elseif ($loop->index % 2 == 1)
    <div class="clearfix visible-sm-block"></div>
@endif