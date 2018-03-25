@php
    \SiteMeta::setMetaTitle(__('meta.403'));

    \SiteBlade::setTitle(__('meta.403'));
    \SiteBlade::setHeadingCenter();
@endphp

@extends('layouts.app')

@section('content')
    {{-- <img src="#" alt="@lang('meta.403')" class="img-responsive" /> --}}
@endsection