{{-- Поле ввода search --}}

<div class="input-group">
    <input name="text"
           type="search"
           id="search_text"
           class="form-control"
           placeholder="@lang('form.search.placeholder')"
           required="required"
           maxlength="200"
           @isset($text)
           value="{{ $text }}"
           @endisset
    />

    <div class="input-group-btn">
        <button type="button" title="@lang('button.clean')" id="search_clean"
                class="btn btn-default hidden-md hidden-lg"
        >
            <i class="fa fa-lg fa-times" aria-hidden="true"></i>
        </button>
        <button type="submit" title="@lang('button.find')" id="search_submit"
                class="btn btn-default"
        >
            <i class="fa fa-lg fa-search" aria-hidden="true"></i>
        </button>
    </div>
</div>