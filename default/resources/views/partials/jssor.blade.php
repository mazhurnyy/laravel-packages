{{-- Слайдер JSSOR. 3 типа - маленький, большой, маленький + большой в модали --}}

{{-- type, title, slides --}}

@push('styles')
    <link rel="stylesheet" href="{{ mix('frontend/plugins/jssor/jssor.css') }}" />
    <link rel="stylesheet" href="{{ mix('frontend/plugins/jssor/jssor-' . $type . '.css') }}" />
@endpush

@push('scripts')
    <script src="{{ mix('frontend/plugins/jssor/jssor.js') }}" defer></script>
    <script src="{{ mix('frontend/plugins/jssor/jssor-' . $type . '.js') }}" defer></script>
@endpush

@include('mazhurnyy::partials.jssor.' . $type)