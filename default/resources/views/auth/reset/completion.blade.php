@php
    \SiteMeta::setMetaTitle(__('meta.reset'));
    \SiteBlade::setTitle(__('meta.reset'));
    \SiteBlade::setHeadingLeft();
    \SiteBlade::setSidebarLeft();
    \SiteBlade::setSidebarRight();
@endphp

{{-- Завершение сброса пароля при переходе по ссылке --}}

@extends('layouts.app')

@section('content')

    @include('partials.form.status')

    <form method="post" action="{{ route('reset.concluding') }}" id="reset_form">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}"/>

        @include('partials.form.email')
        @include('partials.form.password')
        @include('partials.form.confirm')
        @include('partials.form.submit', ['submit' => __('button.finish')])
    </form>

@endsection