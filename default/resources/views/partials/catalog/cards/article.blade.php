{{-- Карточка анонсов дочерних статей --}}

@inject('src', 'Mazhurnyy\Services\Blade\SrcFiles')

<div class="col-xs-12 i">
    <div class="card">

        <div class="h2 visible-xs-block">
            <a href="{{ route('catalog', ['alias' => $item->alias]) }}">{{ $item->title }}</a>
        </div>

        @if (!empty($src->sm($item)))
            <div class="card_img card_img_left">
                <a href="{{ route('article', ['alias' => $item->alias]) }}" title="{{ $item->title }}">
                    <img src="{{ $src->sm($item) }}"
                         alt="{{ $item->title }}"
                         class="img-responsive"
                    />
                </a>
            </div>
        @endif

        <div class="h2 hidden-xs">
            <a href="{{ route('article', ['alias' => $item->alias]) }}">{{ $item->title }}</a>
        </div>

        {!! $item->preview !!}

        <a href="{{ route('article', ['alias' => $item->alias]) }}" title="{{ $item->title }}">
            @lang('button.detailed')
        </a>

        <div class="clearfix mb_half"></div>

    </div>
</div>