{{-- Светлая полоса на диагоналях sm+ --}}

<div class="row hidden-xs mb_base">
    <div class="col-sm-3 col-md-6">

        <div class="h3 logo">
            <a href="{{ route('home') }}">@lang('headers.company.min')</a>
        </div>

    </div>
    <div class="col-sm-9 col-md-4">

        <div class="paragraph_fix"></div>
        @include('partials.header.phones.row')
        @include('partials.header.phones.dropdown')

    </div>
</div>