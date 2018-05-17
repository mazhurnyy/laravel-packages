@php
    \SiteMeta::setMetaTitle(__('meta.register'));
    \SiteBlade::setTitle(__('meta.register'));
    \SiteBlade::setHeadingLeft();
    \SiteBlade::setSidebarLeft();
    \SiteBlade::setSidebarRight();
@endphp

{{-- Начало регистрации --}}

@extends('layouts.app')

@section('content')

    @include('partials.form.status')

    @if (session()->pull('alert') != 'success')
        <form method="post" action="{{ route('register.email') }}" id="register_form">
            {{ csrf_field() }}

            @include('partials.form.email')
            @include('partials.form.submit', ['submit' => __('button.link')])
        </form>

        <div class="row">
            <div class="col-xs-offset-2 col-xs-8 col-sm-offset-1 col-sm-5">
                <a href="{{ route('reset') }}" class="btn btn-link">@lang('button.forgot')</a>
            </div>
            <div class="col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-3">
                <a href="{{ route('login') }}" class="btn btn-link">@lang('button.login')</a>
            </div>
        </div>
    @endif

@endsection
