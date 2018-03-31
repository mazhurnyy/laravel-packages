{{-- Профиль пользователя --}}

@extends('layouts.app')

@section('content')

    @include('partials.form.status')

    <form method="post" action="{{ route('profile.update') }}" id="profile_form">
        {{ csrf_field() }}

        @include('partials.form.email-static')
        @include('partials.form.name')
        @include('partials.form.phone')
        @include('partials.form.address')
        @include('partials.form.submit', ['submit' => __('button.save')])
    </form>

    <div class="row">
        <div class="col-xs-offset-2 col-xs-8 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
            <form method="post" action="{{ route('reset.email') }}" id="reset_form">
                {{ csrf_field() }}
                <input name="email" type="hidden" value="{{ Auth::user()->email }}"/>
                <button type="submit" class="btn btn-link">@lang('button.password_change')</button>
            </form>
        </div>
    </div>

@endsection