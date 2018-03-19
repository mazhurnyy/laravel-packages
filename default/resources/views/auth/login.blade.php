@php
    \SiteMeta::setMetaTitle(__('meta.login'));
    \SiteBlade::setTitle(__('meta.login'));
    \SiteBlade::setHeadingLeft();
@endphp

{{-- Вход --}}

@extends('layouts.app')

@push('scripts')
    <script src="{{ mix('frontend/partials/password.js') }}" defer></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-8 col-md-7 col-lg-6">
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

        </div>
    </div>
@endsection