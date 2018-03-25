{{-- Меню пользователя / Вход --}}

@if (Auth::check())
    <li class="dropdown">
        <a href="#"
           class="dropdown-toggle"
           data-toggle="dropdown"
           role="button"
           aria-haspopup="true"
           aria-expanded="false"
           id="myMenu"
        >
            <i class="fa fa-user-o" aria-hidden="true"></i> @lang('button.my_menu') <span class="caret"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="myMenu">

            @if(Auth::user()->isModerator())
                <li>
                    <a href="{{ route('admin.dashboard', [], false) }}">
                        <i class="fa fa-fw fa-lock" aria-hidden="true"></i> @lang('meta.mc')
                    </a>
                </li>
                <li role="separator" class="divider"></li>
            @endif

            <li>
                <a href="{{ route('profile') }}">
                    <i class="fa fa-fw" aria-hidden="true"></i> @lang('meta.profile')
                </a>
            </li>

            <li>
                <a href="{{ route('orders') }}">
                    <i class="fa fa-fw" aria-hidden="true"></i> @lang('meta.orders')
                </a>
            </li>

            <li role="separator" class="divider"></li>

            <li>
                <a href="{{ route('exit') }}">
                    <i class="fa fa-fw fa-sign-out" aria-hidden="true"></i> @lang('meta.logout')
                </a>
            </li>

        </ul>
    </li>
@else
    <li>
        <a href="{{ route('login') }}">
            <i class="fa fa-sign-in" aria-hidden="true"></i> @lang('meta.login')
        </a>
    </li>
@endif