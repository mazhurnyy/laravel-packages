@php
    \SiteMeta::setMetaTitle(__('meta.register'));
    \SiteBlade::setTitle(__('meta.register'));
    \SiteBlade::setHeadingLeft();
    \SiteBlade::setSidebarLeft();
    \SiteBlade::setSidebarRight();
@endphp

{{-- Завершение регистрации при переходе по ссылке --}}

@extends('layouts.app')

@section('content')

    @include('partials.form.status')

    <form method="post" action="{{ route('register.concluding') }}" id="register_form">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}"/>

        @include('partials.form.email-static')
        @include('partials.form.name')
        @include('partials.form.phone')
        @include('partials.form.password')
        @include('partials.form.confirm')
        @include('partials.form.submit', ['submit' => __('button.finish')])
    </form>

@endsection