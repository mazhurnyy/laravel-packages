{{-- Разворачиваем ссылки для верхнего / нижнего меню ПЕРЕДЕЛАТЬ --}}

@foreach (config('biatron.menu.' . $type) as $i => $i_link)

    @if (isset($i_link['children']))

        <li class="dropdown">
            <a href="#"
               class="dropdown-toggle"
               data-toggle="dropdown"
               role="button"
               aria-haspopup="true"
               aria-expanded="false"
            >
                @lang('menu.' . $type . '.'  . $i . '.title') <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">

                @foreach (config('biatron.menu.' . $type . '.'  . $i . '.children') as $j => $j_link)
                    <li>
                        @if (!empty($j_link['alias']))

                            <a href="{{ route($j_link['route'], ['alias' => $j_link['alias']]) }}">
                                @lang('menu.' . $type . '.' . $i . '.children.' . $j . '.title')
                            </a>

                        @else

                            <a href="{{ route($j_link['route']) }}">
                                @lang('menu.' . $type . '.' . $i . '.children.' . $j . '.title')
                            </a>

                        @endif
                    </li>
                @endforeach

            </ul>
        </li>

    @else
        <li>
            @if (!empty($i_link['alias']))

                <a href="{{ route($i_link['route'], ['alias' => $i_link['alias']]) }}">
                    @lang('menu.' . $type . '.'  . $i . '.title')
                </a>

            @else

                <a href="{{ route($i_link['route']) }}">
                    @lang('menu.' . $type . '.'  . $i . '.title')
                </a>

            @endif
        </li>

    @endif

@endforeach