{{-- Результаты быстрого поиска --}}

@forelse ($results as $result)
    <h4>{{ $result['title'] }}:</h4>
    <ol class="mb_half">
        @foreach ($result['items'] as $item)
            @foreach ($string_search as $word)
                @php
                    $pattern = '/(' . $word . ')/iu';
                    $replacement = '<strong class="text-danger">' . "$1" . '</strong>';
                    $item['title'] = preg_replace($pattern, $replacement, $item['title']);
                @endphp
            @endforeach
            <li><a href="{{ $item['link'] }}" class="search_link">{!! $item['title'] !!}</a></li>
        @endforeach
    </ol>
    <div class="alert alert-success" role="alert">
        @lang('headers.found')
        <span class="badge badge-success">{{ $result['count'] }}</span>.
        <a href="{{ $result['search'] }}" class="alert-link search_link">@lang('headers.all_results')</a>
    </div>
@empty
    <div class="alert alert-danger" role="alert">
       @lang('status.sample_null')
    </div>
@endforelse