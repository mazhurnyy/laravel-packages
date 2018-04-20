{{-- Карточка изображения --}}

@php
    $class = $item->deleted_at ? 'deleted' : 'actual' ;

    if (request()->session()->has('gallery_filter')) {

        if (request()->session()->get('gallery_filter') != 'all') {

            if (request()->session()->get('gallery_filter') != $class) {
                $class .= ' hidden';
            }
        }
    }
@endphp

<div class="col-sm-4 col-md-3 col-lg-2 mb_base {{ $class }}">

    <div class="image_table">
        <div class="image_cell">

            {{-- todo alt из файлохранилища, name - не локализован, нужен title которого нет --}}
            {{-- todo размеры префиксов tznp и biatron не совпадают --}}
            <img src="{{ $item->src_thumb }}"
                 alt="{{ $item->name }}"
                 class="img-responsive c_zoom"
                 data-toggle="modal"
                 data-target="#modalImage"
                 data-src="{{ $item->src_preview}}"
            />

        </div>
    </div>
    <div class="image_buttons">

        @if (empty($item->deleted_at))
            <div class="row">
                <div class="col-xs-4 p_none">
                    @include('mazhurnyy::partials.gallery.card.left')
                </div>
                <div class="col-xs-4 p_none">
                    @include('mazhurnyy::partials.gallery.card.delete')
                </div>
                <div class="col-xs-4 p_none">
                    @include('mazhurnyy::partials.gallery.card.right')
                </div>
            </div>
        @else
            @include('mazhurnyy::partials.gallery.card.restore')
        @endif

    </div>

</div>