{{-- Карточка заказов --}}

<div class="col-xs-12 i">
    <div class="orders_card">

        <div class="row">
            <div class="col-xs-6 col-sm-3">

                <a href="{{ route('order', ['id' => $item->id]) }}">@lang('headers.order.order'){{ $item->id }}</a>

            </div>
            <div class="col-xs-6 col-sm-3">

                @lang('headers.order.date'): <strong>{{ $item->created_at->format('d.m.Y') }}</strong>

            </div>
            <div class="col-xs-6 col-sm-3">

                @lang('headers.order.status'): <strong>{{-- todo пропало $item->statusOrder->title --}}</strong>

            </div>
            <div class="col-xs-6 col-sm-3">

                @lang('headers.order.sum'): <strong>{{ $item->amount }}</strong>&nbsp;@lang('headers.souvenir.grn')

            </div>
        </div>

    </div>
</div>