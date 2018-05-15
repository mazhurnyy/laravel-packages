{{-- Управление изображениями галереи --}}

@push('scripts')
    <script src="{{ mix('frontend/partials/gallery.js') }}" defer></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ mix('frontend/styles/gallery.css') }}"/>
@endpush

@include('mazhurnyy::partials.gallery.filter')

<div class="row">
    @foreach ($results as $item)
        @include('mazhurnyy::partials.gallery.card')
    @endforeach
</div>

@include('mazhurnyy::partials.gallery.errors')
@include('mazhurnyy::partials.gallery.add')
@include('mazhurnyy::partials.gallery.modal')
