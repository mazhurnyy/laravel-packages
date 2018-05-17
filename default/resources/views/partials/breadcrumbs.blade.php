{{-- Хлебные крошки --}}

@if (count(SiteBlade::getBreadcrumbs()) > 1)
    <ol class="breadcrumb">
        @foreach(SiteBlade::getBreadcrumbs() as $breadcrumb)
            <li>
                <a href="{{ $breadcrumb['link'] }}">
                    @if ($loop->iteration == 1)
                        <i class="fa fa-home" aria-hidden="true"></i>
                    @endif
                    {{ $breadcrumb['title'] }}
                </a>
            </li>
        @endforeach
    </ol>
@endif