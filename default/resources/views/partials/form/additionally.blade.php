{{-- Поле ввода additionally --}}

@push('styles')
    <link rel="stylesheet" href="{{ mix('frontend/plugins/summernote/summernote.css') }}" />
@endpush

@push('scripts')
    <script src="{{ mix('frontend/plugins/summernote/summernote.js') }}" defer></script>
@endpush

<div class="form-group{{ $errors->has('additionally') ? ' has-error' : '' }}">
    <label for="additionally">@lang('form.additionally.label'):</label>

    <textarea name="additionally"
              id="additionally"
              rows="6"
              class="form-control"
              maxlength="500"
              placeholder="@lang('form.additionally.placeholder')"
    >
        @if (isset($additionally))
            {!! $additionally !!}
        @else
            {!! old('additionally') !!}
        @endif
    </textarea>

    <div class="hidden summernote">
        @if (isset($additionally))
            {!! $additionally !!}
        @else
            {!! old('additionally') !!}
        @endif
    </div>

    @if ($errors->has('additionally'))
        <span class="help-block">
            <strong>{{ $errors->first('additionally') }}</strong>
        </span>
    @endif
</div>