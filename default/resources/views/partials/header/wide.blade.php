{{-- Верхнее широкое меню --}}

<div class="navbar-header visible-xs-block">
    <button type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#top-menu"
            aria-expanded="false"
    >
        <span class="sr-only">@lang('button.toggle_menu')</span>
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>

    <button type="button"
            class="navbar-toggle"
            data-toggle="collapse"
            data-target="#contactsWide"
            aria-expanded="false"
            aria-controls="contactsWide"
    >
        <span class="sr-only">@lang('button.contacts')</span>
        <i class="fa fa-phone" aria-hidden="true"></i>
    </button>

    <a href="{{ asset('') }}" class="navbar-brand">
        {{--<img src="{{ asset('frontend/img/logo.png') }}" alt="лого" height="48" width="48"/>--}}
        @lang('headers.company.min')
    </a>
</div>

<div class="collapse navbar-collapse" id="top-menu">
    <ul class="nav navbar-nav">
        @include('partials.links', ['type' => 'top'])
    </ul>
</div>