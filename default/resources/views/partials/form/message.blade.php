{{-- Поле ввода message --}}

@push('styles')
    <link rel="stylesheet" href="{{ mix('frontend/plugins/summernote/summernote.css') }}" />
@endpush

@push('scripts')
    <script src="{{ mix('frontend/plugins/summernote/summernote.js') }}" defer></script>
@endpush

<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
    <label for="message">@lang('form.message.label'):</label>

    <textarea name="message"
              id="message"
              rows="6"
              class="form-control"
              maxlength="500"
              placeholder="@lang('form.message.placeholder')"
    >
        @if (isset($message))
            {!! $message !!}
        @else
            {!! old('message') !!}
        @endif
    </textarea>

    <div class="hidden summernote">
        @if (isset($message))
            {!! $message !!}
        @else
            {!! old('message') !!}
        @endif
    </div>

    @if ($errors->has('message'))
        <span class="help-block">
            <strong>{{ $errors->first('message') }}</strong>
        </span>
    @endif
</div>