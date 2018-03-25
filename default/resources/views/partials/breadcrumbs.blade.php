{{-- Хлебные крошки --}}

{{-- todo Все универсальные сущности должны наследоваться от главной и раскручиваться одим циклом --}}
{{-- todo Как сделать крошки в заказе (служебная страница) - вопрос --}}

@if (count(\SiteBlade::getBreadcrumbs()) > 0)
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">@lang('meta.home.title')</a></li>

        @foreach(\SiteBlade::getBreadcrumbs() as $breadcrumb)
            <li><a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['title'] }}</a></li>
        @endforeach
    </ol>
@endif