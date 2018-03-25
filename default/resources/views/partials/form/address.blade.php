{{-- Поле ввода address --}}

<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    <label for="address">@lang('form.address.label'):</label>

    <textarea name="address"
              id="address"
              rows="6"
              class="form-control"
              maxlength="300"
              required="required"
              placeholder="@lang('form.address.placeholder')"
    >@if (old('address')){{ old('address') }}@elseif (Auth::user()){{ Auth::user()->address }}@endif</textarea>

    @if ($errors->has('address'))
        <span class="help-block">
            <strong>{{ $errors->first('address') }}</strong>
        </span>
    @endif
</div>