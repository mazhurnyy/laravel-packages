@php
    SiteMeta::setMetaTitle(__('meta.reset'));
    SiteBlade::setTitle(__('meta.reset'));
    SiteBlade::setHeadingLeft();
@endphp

{{-- Завершение сброса пароля при переходе по ссылке --}}

@extends('layouts.app')

@push('scripts')
    <script src="{{ mix('frontend/partials/password.js') }}" defer></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-8 col-md-7 col-lg-6">
            @include('partials.form.status')

            <form method="post" action="{{ route('reset.concluding') }}" id="reset_form">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}" />

                @include('partials.form.email')
                @include('partials.form.password')
                @include('partials.form.confirm')
                @include('partials.form.submit', ['submit' => __('button.finish')])
            </form>

        </div>
    </div>
@endsection