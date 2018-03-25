{{-- Заголовок Н1 --}}

@if (!empty(SiteBlade::getTitlePrimary()))
    <h1 class="text-{{ SiteBlade::getHeadingAlign() }}">
        {{ SiteBlade::getTitlePrimary() }}

        @if (!empty(SiteBlade::getTitleSecondary()))
            <small>{{ SiteBlade::getTitleSecondary() }}</small>
        @endif
    </h1>
@endif