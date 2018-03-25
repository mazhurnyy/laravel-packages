{{-- Выбор доставки --}}

<div class="form-group{{ $errors->has('delivery') ? ' has-error' : '' }}">
    <label for="delivery">@lang('form.delivery.label'):</label>

    <select name="delivery" id="delivery" class="form-control">
        @foreach ($delivery as $item)
            <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
        @endforeach
    </select>

    @if ($errors->has('delivery'))
        <span class="help-block">
            <strong>{{ $errors->first('delivery') }}</strong>
        </span>
    @endif
</div>