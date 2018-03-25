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

            <img src="{{ $item->src_thumb }}"
                 data-src="{{ $item->src_preview}}"
                 class="img-responsive c_zoom"
                 alt="{{ $item->name }}"
                 data-toggle="modal"
                 data-target="#modalImage"
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