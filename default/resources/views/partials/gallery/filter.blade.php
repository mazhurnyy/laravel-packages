{{-- Строка фильтров галереи --}}

@php
$filters = ['all', 'actual', 'deleted'];
$current = request()->session()->has('gallery_filter') ? request()->session()->get('gallery_filter') : 'all';
@endphp

<div class="mb_half">
    <ul class="nav nav-pills" data-action="{{ route('file.filter') }}">

        @foreach($filters as $filter)

            @if ($filter == $current)
                <li role="presentation" data-filter="{{ $filter }}" class="active">
                    <h2>@lang('gallery.filter.' . $filter)</h2>
                </li>
            @else
                <li role="presentation" data-filter="{{ $filter }}">
                    <a href="#">@lang('gallery.filter.' . $filter)</a>
                </li>
            @endif

        @endforeach

    </ul>
    <div class="paragraph_fix"></div>
</div>