{{-- Карточка заказов --}}

<tr class="position i">
    <td>
        <a href="{{ route('order', ['id' => $item->id]) }}">
            @lang('headers.order.order') №{{ $item->invoice }}
        </a>
    </td>
    <td>
        <strong>{{ $item->created_at->format('d.m.Y') }}</strong>
    </td>
    <td>
        {{ $item->status->title }}
    </td>
    <td>
        <strong>{{ $item->amount }}</strong>&nbsp;@lang('headers.product.grn')
    </td>
</tr>