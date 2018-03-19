@php
    \SiteMeta::setMetaTitle(__('meta.register'));
    \SiteBlade::setTitle(__('meta.register'));
    \SiteBlade::setHeadingLeft();
@endphp

{{-- Завершение регистрации при переходе по ссылке --}}

@extends('layouts.app')

@push('scripts')
    <script src="{{ mix('frontend/plugins/inputmask/inputmask.js') }}" defer></script>
    <script src="{{ mix('frontend/partials/password.js') }}" defer></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-8 col-md-7 col-lg-6">
            @include('partials.form.status')

            <form method="post" action="{{ route('register.concluding') }}" id="register_form">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}" />

                @include('partials.form.email-static')
                @include('partials.form.name')
                @include('partials.form.phone')
                @include('partials.form.password')
                @include('partials.form.confirm')
                @include('partials.form.submit', ['submit' => __('button.finish')])
            </form>

        </div>
    </div>
@endsection