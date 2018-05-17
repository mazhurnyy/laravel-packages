{{-- Обратная связь --}}

@extends('layouts.app')

@section('content')

    @include('partials.form.status')

    <form method="post" action="{{ route('feedback.create') }}" id="feedback_form">
        {{ csrf_field() }}

        @if (!Auth::user())
            @include('partials.form.name')
            @include('partials.form.email')
        @endif

        @include('partials.form.editor', ['editor' => ['type' => 'message']])
        @include('partials.form.submit', ['submit' => __('button.send')])
    </form>

    @if (Auth::user())
        @include('partials.catalog')
    @endif

@endsection