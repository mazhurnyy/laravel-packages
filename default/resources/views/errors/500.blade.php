@php
    \SiteMeta::setMetaTitle(__('meta.500'));

    \SiteBlade::setTitle(__('meta.500'));
    \SiteBlade::setHeadingCenter();
@endphp

@extends('layouts.app')

@section('content')
    {{-- <img src="#" alt="@lang('meta.500')" class="img-responsive" /> --}}
@endsection