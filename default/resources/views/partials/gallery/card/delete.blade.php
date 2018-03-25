{{-- Удалить изображение из галереи --}}

<form method="post" action="{{ route('file.delete') }}">
    {{ csrf_field() }}

    <input type="hidden" name="file_id" value="{{ $item->id }}" />
    <input type="hidden" name="id" value="{{ $id }}" />
    <input type="hidden" name="type" value="{{ $type }}" />

    <button type="submit" class="btn btn-default" title="@lang('gallery.delete')">
        <i class="fa fa-trash-o" aria-hidden="true"></i>
    </button>
</form>