{{-- Подвал сайта: меню + контакты --}}

@php
$year = ((int)date('Y') > config('biatron.year')) ? config('biatron.year') . ' - ' . date('Y') : config('biatron.year');
@endphp

<footer class="footer_wrap">

    <div class="menu_narrow mb_half">
        <nav class="container">

            <ul class="list-inline">
                @include('partials.links', ['type' => 'bottom'])
            </ul>

        </nav>
    </div>

    <div class="container">

        <div class="mb_half">&copy; {{ $year }} @lang('headers.company.max')</div>

    </div>

</footer>