{{-- Обратная связь --}}

@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ mix('frontend/plugins/summernote/summernote.css') }}" />
@endpush

@push('scripts')
    <script src="{{ mix('frontend/plugins/summernote/summernote.js') }}" defer></script>
@endpush

@if (Auth::user())
    @push('scripts')
        <script src="{{ mix('frontend/partials/more-scroll.js') }}" defer></script>
    @endpush
@endif

@section('content')
    <div class="row">
        <div class="col-sm-8 col-md-7 col-lg-6">
            @include('partials.form.status')
            
            <form method="post" action="{{ route('feedback.create') }}" id="feedback_form">
                {{ csrf_field() }}

                @if (!Auth::user())
                    @include('partials.form.name')
                    @include('partials.form.email')
                @endif

                @include('partials.form.message')
                @include('partials.form.submit', ['submit' => __('button.send')])
            </form>

            @if (Auth::user())
                @include('partials.catalog')
            @endif
        </div>
    </div>
@endsection