{{-- Поле ввода email --}}

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email">@lang('form.email.label'):</label>

    <input name="email"
           type="email"
           id="email"
           class="form-control"
           @if (session()->has('email'))
           value="{{ session('email') }}"
           @elseif (old('email'))
           value="{{ old('email') }}"
           @elseif (Auth::user())
           value="{{ Auth::user()->email }}"
           @else
           value=""
           @endif
           maxlength="200"
           required="required"
           placeholder="@lang('form.email.placeholder')"
           autofocus="autofocus"
    />

    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>