{{-- Статья --}}

@extends('layouts.app')

@section('content')
    <div class="main">{!! $article->text !!}</div>

    @include('partials.catalog')
@endsection