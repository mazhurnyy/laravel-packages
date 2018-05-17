@php
    \SiteMeta::setMetaTitle(__('meta.401'));

    \SiteBlade::setTitle(__('meta.401'));
    \SiteBlade::setHeadingCenter();
@endphp

@extends('layouts.app')

@section('content')
    {{-- <img src="#" alt="@lang('meta.401')" class="img-responsive" /> --}}

    <div class="login_401"></div>

    <div class="row">
        <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
            <a href="{{ route('login') }}" class="btn btn-primary">@lang('button.login')</a>
        </div>
    </div>
@endsection