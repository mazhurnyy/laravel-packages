@php
    \SiteMeta::setMetaTitle(__('meta.404'));

    \SiteBlade::setTitle(__('meta.404'));
    \SiteBlade::setHeadingCenter();
@endphp

@extends('layouts.app')

@section('content')
    {{-- <img src="#" alt="@lang('meta.404')" class="img-responsive" /> --}}
@endsection