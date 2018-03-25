{{-- Флажок remember --}}

<div class="form-group">
    <div class="checkbox">
        <label>
            <input name="remember"
                   type="checkbox"
                   {{-- Если человек впервые открыл форму, то old('email') нету и мы включаем флаг --}}
                   {{ old('email') ? '' : 'checked="checked"' }}
                   {{-- Если человек уже отправлял форму, то ориентируемся на old('remember') --}}
                   {{ old('remember') ? 'checked="checked"' : '' }}
            /> @lang('form.remember.label')
        </label>
    </div>
</div>