{{-- Карточка галерей в портфолио --}}

@inject('src', 'Mazhurnyy\Services\Blade\SrcFiles')

<div class="col-sm-6 col-md-4 i">
    <div class="card">

        @if (!empty($src->sm($item)))
            <div class="card_img">

                <img src="{{ $src->sm($item) }}"
                     alt="{{ $item->title }}"
                     class="img-responsive c_zoom"
                     data-id="{{ $item->id }}"
                     data-toggle="modal"
                     data-target="#modal"
                />

            </div>
        @endif

        <div class="h2 text-center">
            {{ $item->title }}
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