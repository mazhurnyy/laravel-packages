{{-- Подменю для параллельных разделов --}}

<ul class="nav nav-pills">
    <li role="presentation" class="active"><h2>{{ $nav['title'] }}</h2></li>

    @foreach ($nav['pills'] as $pill)
        <li role="presentation">
            <a href="{{ $pill['link'] }}">
                {{ $pill['title'] }}
                <span class="badge badge-link">{{ $pill['amount'] }}</span>
            </a>
        </li>
    @endforeach
</ul>