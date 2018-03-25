{{-- Выбор языка локализации --}}

<li class="dropdown">
    <a href="#"
       class="dropdown-toggle"
       data-toggle="dropdown"
       role="button"
       aria-haspopup="true"
       aria-expanded="false"
       id="language"
    >
        {{ LaravelLocalization::getCurrentLocaleNative() }}
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="language">

        @foreach(LaravelLocalization::getSupportedLocales(true) as $localeCode => $properties)
            <li>
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                   hreflang="{{ $localeCode }}"
                   rel="alternate"
                >
                    {{ $properties['native'] }}
                </a>
            </li>
        @endforeach

    </ul>
</li>