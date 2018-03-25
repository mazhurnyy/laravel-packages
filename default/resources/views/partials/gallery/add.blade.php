{{-- Добавление изображения в галерею --}}

<form method="post" action="{{ route('file.add') }}" enctype="multipart/form-data" id="form_add">
    {{ csrf_field() }}

    <label class="d_b mb_none">
        <span role="button" class="btn btn-success add_submit">
            @lang('gallery.add')
        </span>
        <span role="button" class="btn btn-success hidden add_spinner">
            <i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> @lang('gallery.processing')
        </span>
        <input type="file" name="file" class="hidden" />
    </label>

    <input type="hidden" name="id" value="{{ $id }}" />
    <input type="hidden" name="type" value="{{ $type }}" />
</form>