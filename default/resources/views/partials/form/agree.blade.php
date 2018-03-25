{{-- Флажок agree --}}

<div class="form-group">
    <div class="checkbox">
        <label>
            <input name="agree"
                   type="checkbox"
                   required="required"
                   checked="checked"
            /> @lang('form.agree.label')
        </label>

        <a href="{{ route('article', ['alias' => config('biatron.form.agree.alias')]) }}">@lang('form.agree.title')</a>
    </div>
</div>