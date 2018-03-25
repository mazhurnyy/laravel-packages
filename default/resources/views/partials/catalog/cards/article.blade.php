{{-- Карточка анонсов статей --}}

{{-- todo ну и как теперь в статье Товары и услуги вывести анонсы каталогов и анонс статьи Услуги? --}}
{{-- todo route (x3) ===> $item->type --}}

<div class="col-xs-12 i">
    <div class="card">

        <div class="preview_left">
            <a href="{{ route('catalog', ['alias' => $item->alias]) }}"
               title="{{ $item->title }}"
            >
                <img src="{{ $item->firstImage[0]->src_preview }}"
                     alt="{{ $item->title }}"
                     {{-- class="img-responsive" --}}
                     height="207" width="368"
                />
            </a>
        </div>

        <div class="h3">
            <a href="{{ route('catalog', ['alias' => $item->alias]) }}">{{ $item->title }}</a>
        </div>

        {!! $item->preview !!}

        <div class="paragraph_fix"></div>

        <a href="{{ route('article', ['alias' => $item->alias]) }}" title="{{ $item->title }}">
            @lang('button.detailed')
        </a>

        <div class="clearfix"></div>

    </div>
</div>