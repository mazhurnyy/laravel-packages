{{-- Контакты в шапке для md и lg --}}

<div class="dropdown hidden-sm">
    <a href="#"
       class="dropdown-toggle"
       data-toggle="dropdown"
       role="button"
       aria-haspopup="true"
       aria-expanded="false"
       id="contactsLight"
    >
        <span id="current_phone">
            <span title="Київстар" class="mobo-kievstar-16">{{ config('biatron.phones.kievstar') }}</span>
        </span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="contactsLight">
        <li>
            <a href="#" class="phone" id="lifecell">
                <span title="Lifecell" class="mobo-lifecell-16">{{ config('biatron.phones.lifecell') }}</span>
            </a>
        </li>
        <li>
            <a href="#" class="phone" id="vodafone">
                <span title="Vodafone" class="mobo-vodafone-16">{{ config('biatron.phones.vodafone') }}</span>
            </a>
        </li>
        <li role="separator" class="divider"></li>
        <li>
            <a href="{{ route('feedback') }}">
                <i class="fa fa-envelope-o" aria-hidden="true"></i> @lang('meta.feedback')
            </a>
        </li>
    </ul>
</div>