{{-- Статья --}}

{{-- todo подменять alt картинок на текущий $article->title --}}

@php
    $article_text = str_replace('style="float:left"', 'class="img-responsive card_img card_img_left"', $article->text);
    $article_text = str_replace('style="float:right"', 'class="img-responsive card_img card_img_right"', $article_text);
@endphp

@extends('layouts.app')

@section('content')
    {!! $article_text !!}

    @include('partials.catalog')
@endsection