{{-- Статья --}}

@extends('layouts.app')

@push('scripts')
    <script src="{{ mix('frontend/partials/more-scroll.js') }}" defer></script>
@endpush

@section('content')
    <div class="main">{!! $article->text !!}</div>

    @include('partials.catalog')
@endsection

{{--
<div class="row">
        <div class="col-md-offset-2 col-md-8">
        </div>
</div>


<div class="row mb_base" id="catalog">
    @foreach($catalog['results'] as $descendant)

        <a href="{{ route($types[$descendant->essence_type_id], $descendant->alias)  }}">
            {{ $descendant->title }}
        </a>

    @endforeach
</div>
--}}