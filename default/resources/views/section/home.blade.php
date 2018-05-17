{{-- Главная страница --}}

@extends('layouts.app')

@section('content')
    {!! $sheet->text !!}

    @include('partials.previews')
@endsection