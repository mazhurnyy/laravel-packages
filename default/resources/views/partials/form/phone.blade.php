{{-- Поле ввода phone --}}

@push('scripts')
    <script src="{{ mix('frontend/plugins/inputmask/inputmask.js') }}" defer></script>
@endpush

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    <label for="phone">@lang('form.phone.label'):</label>

    <input name="phone"
           type="tel"
           id="phone"
           class="form-control"
           @if (old('phone'))
           value="{{ old('phone') }}"
           @elseif (Auth::user())
           value="{{ Auth::user()->phone }}"
           @else
           value=""
           @endif
           maxlength="20"
           required="required"
           placeholder="@lang('form.phone.placeholder')"
    />

    @if ($errors->has('phone'))
        <span class="help-block">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
    @endif
</div>