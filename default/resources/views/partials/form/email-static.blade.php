{{-- Статичное отображение email --}}

<div class="form-group">
    <label>@lang('form.email.label'):</label>

    <p class="form-control-static">
        @if (Auth::user())
            {{ Auth::user()->email }}
        @else
            {{ $email }}
        @endif
    </p>
</div>