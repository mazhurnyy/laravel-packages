{{-- Поле ввода name --}}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">@lang('form.name.label'):</label>

    <input name="name"
           type="text"
           id="name"
           class="form-control"
           @if (old('name'))
           value="{{ old('name') }}"
           @elseif (Auth::user())
           value="{{ Auth::user()->name }}"
           @else
           value=""
           @endif
           maxlength="200"
           required="required"
           placeholder="@lang('form.name.placeholder')"
           autofocus="autofocus"
    />

    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>