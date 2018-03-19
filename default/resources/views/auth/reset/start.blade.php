@php
    SiteMeta::setMetaTitle(__('meta.reset'));
    SiteBlade::setTitle(__('meta.reset'));
    SiteBlade::setHeadingLeft();
@endphp

{{-- Начало сброса пароля --}}

@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-sm-8 col-md-7 col-lg-6">
            @include('partials.form.status')

            @if (session()->pull('alert') != 'success')
                <form method="post" action="{{ route('reset.email') }}" id="reset_form">
                    {{ csrf_field() }}

                    @include('partials.form.email')
                    @include('partials.form.submit', ['submit' => __('button.link')])
                </form>

                <div class="row">
                    <div class="col-xs-offset-2 col-xs-8 col-sm-offset-1 col-sm-5">
                        <a href="{{ route('register') }}" class="btn btn-link">@lang('button.register')</a>
                    </div>
                    <div class="col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-3">
                        <a href="{{ route('login') }}" class="btn btn-link">@lang('button.login')</a>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection