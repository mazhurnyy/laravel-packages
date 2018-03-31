{{-- Форма быстрого поиска --}}

<form method="post" action="{{ route('search') }}" class="mb_base" id="search_form">
    {{ csrf_field() }}

    @include('partials.form.search')
    
    <div class="well hidden search_fast_result" id="search_result"></div>
    
    <div class="hidden" id="search_loading">
        <div class="mb_base">
            <i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> @lang('button.loading')
        </div>
    </div>
</form>