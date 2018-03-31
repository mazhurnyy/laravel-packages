{{-- Контакты в шапке для xs и sm --}}

<div class="row left_sm_right">
    <div class="col-xs-6 col-sm-4 hidden-md hidden-lg mb_half">

        <span title="Київстар" class="mobo-kievstar-16">{{ config('biatron.phones.kievstar') }}</span>

    </div>
    <div class="col-xs-6 col-sm-4 hidden-md hidden-lg mb_half">

        <span title="Lifecell" class="mobo-lifecell-16">{{ config('biatron.phones.lifecell') }}</span>

    </div>
    <div class="col-xs-6 col-sm-4 hidden-md hidden-lg mb_half">

        <span title="Vodafone" class="mobo-vodafone-16">{{ config('biatron.phones.vodafone') }}</span>

    </div>
    <div class="col-xs-6 hidden-sm hidden-md hidden-lg mb_half">

        <a href="{{ route('feedback') }}">
            <i class="fa fa-envelope-o" aria-hidden="true"></i> @lang('meta.feedback')
        </a>

    </div>
</div>