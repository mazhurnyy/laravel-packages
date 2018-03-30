@php
    \SiteMeta::setMetaTitle(__('meta.login'));
    \SiteBlade::setTitle(__('meta.login'));
    \SiteBlade::setHeadingLeft();
    \SiteBlade::setSidebarLeft();
    \SiteBlade::setSidebarRight();
@endphp

{{-- Вход --}}

@extends('layouts.app')

@section('content')

    @include('partials.form.status')

    <form method="post" action="{{ route('login.check') }}" id="login_form">
        {{ csrf_field() }}

        @include('partials.form.email')
        @include('partials.form.password')
        @include('partials.form.remember')
        @include('partials.form.submit', ['submit' => __('button.login')])
    </form>

    <div class="col-xs-offset-2 col-xs-8 col-sm-offset-1 col-sm-5">
        <a href="{{ route('reset') }}" class="btn btn-link">@lang('button.forgot')</a>
    </div>
    <div class="col-xs-offset-2 col-xs-8 col-sm-offset-1 col-sm-5">
        <a href="{{ route('register') }}" class="btn btn-link">@lang('button.register')</a>
    </div>

@endsection