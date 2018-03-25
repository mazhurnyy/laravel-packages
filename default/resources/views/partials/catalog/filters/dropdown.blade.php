{{-- Выпадающий список --}}

<div class="d_ib mb_half">
    <strong>{{ $filter['name'] }}:</strong>

    <div class="dropdown d_ib filter_item">
        <span role="button"
              class="dropdown-toggle"
              id="{{ $filter['alias'] }}"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="true"
        >
            {{ $filter['selected']['name'] }} <span class="caret"></span>
        </span>

        <ul class="dropdown-menu" aria-labelledby="{{ $filter['alias'] }}">
            @foreach ($filter['meanings'] as $meanings)
                @if (!in_array($meanings['value'], $filter['selected']['value']))
                    <li>
                        <a href="{{ \Filters::getSectionUrl(). '/' . $meanings['url'] }}">{{ $meanings['title'] }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>