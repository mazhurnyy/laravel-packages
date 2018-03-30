{{-- Поле ввода password --}}

@push('scripts')
    <script src="{{ mix('frontend/partials/password.js') }}" defer></script>
@endpush

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password">@lang('form.password.label'):</label>

    <div class="input-group">
        <input name="password"
               type="password"
               id="password"
               class="form-control password"
               @if (session()->has('password'))
               value="{{ session('password') }}"
               @else
               value="{{ old('password') }}"
               @endif
               maxlength="200"
               required="required"
               placeholder="@lang('form.password.placeholder')"
        />

        <div class="input-group-btn">
            <button type="button" class="btn btn-default"
                    title="@lang('button.password_show')"
                    id="btn_pwd_show"
            >
                <i class="fa fa-lg fa-eye" aria-hidden="true"></i>
            </button>
            <button type="button" class="btn btn-default hidden"
                    title="@lang('button.password_hide')"
                    id="btn_pwd_hide"
            >
                <i class="fa fa-lg fa-eye-slash" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>