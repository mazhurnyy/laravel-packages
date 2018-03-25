{{-- Поле ввода подтверждения пароля confirm --}}

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label for="password_confirmation">@lang('form.confirm.label'):</label>

    <input name="password_confirmation"
           type="password"
           id="password_confirmation"
           class="form-control password"
           @if (session()->has('password_confirmation'))
           value="{{ session('password_confirmation') }}"
           @else
           value="{{ old('password_confirmation') }}"
           @endif
           maxlength="200"
           required="required"
           placeholder="@lang('form.confirm.placeholder')"
    />

    @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif
</div>