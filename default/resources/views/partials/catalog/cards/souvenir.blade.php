{{-- Карточка сувениров --}}

@inject('src', 'Mazhurnyy\Services\Blade\SrcFiles')

<div class="col-xs-6 col-sm-3 col-lg-2 i">
    <div class="card">

        <div class="card_top souvenir_width">
            <a href="{{ route('souvenir', ['alias' => $item->alias]) }}" title="{{ $item->title }}">
                <img src="{{ $src->preview($item) }}"
                     alt="{{ $item->title }}"
                     class="img-responsive"
                />
            </a>
        </div>

        <div class="card_bottom souvenir_width">
            <div class="souvenir_title">
                <a href="{{ route('souvenir', ['alias' => $item->alias]) }}">
                    {{ $item->title }}
                </a>
            </div>

            <div class="h5 text-danger">
                <strong>{{ $item->price }}</strong>&nbsp;@lang('headers.souvenir.grn')
            </div>

            <div class="mb_half">
                {{ $item->status->title }}
            </div>

            @include('section.basket.position.add', ['id' => $item->id])
        </div>

    </div>
</div>

@if ($loop->index % 12 == 11)
    <div class="clearfix"></div>
@elseif ($loop->index % 6 == 5)
    <div class="clearfix visible-xs-block visible-lg-block"></div>
@elseif ($loop->index % 4 == 3)
    <div class="clearfix hidden-lg"></div>
@elseif ($loop->index % 2 == 1)
    <div class="clearfix visible-xs-block"></div>
@endif