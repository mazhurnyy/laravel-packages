{{-- Расширенный поиск --}}

{{-- todo текст поиска вшит в meta.search, подставлять в контроллере --}}

@extends('layouts.app')

@push('scripts')
    <script src="{{ mix('frontend/partials/more-scroll.js') }}" defer></script>
    <script src="{{ mix('frontend/partials/basket-add.js') }}" defer></script>
@endpush

@section('content')
    @include('partials.catalog')
@endsection