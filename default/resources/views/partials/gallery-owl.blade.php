{{-- Управление изображениями галереи --}}

@push('footer-scripts')
    <script src="{{ mix('frontend/plugins/bootstrap-v3/modal.js') }}" defer></script>
    <script src="{{ mix('frontend/partials/gallery.js') }}" defer></script>
    <link rel="stylesheet" href="{{ mix('frontend/styles/gallery.css') }}" />
    <link rel="stylesheet" href="{{ mix('frontend/styles/gallery-owl.css') }}" />
@endpush

<div id="gallery-owl">
    @include('mazhurnyy::partials.gallery.filter')

    <div class="row">
        @foreach ($results as $item)
            @include('mazhurnyy::partials.gallery.card')
        @endforeach
    </div>

    @include('mazhurnyy::partials.gallery.errors')
    @include('mazhurnyy::partials.gallery.add')
    @include('mazhurnyy::partials.gallery.modal')
</div>