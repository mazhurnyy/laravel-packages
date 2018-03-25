{{-- Восстановление изображения галереи --}}

<form method="post" action="{{ route('file.restore') }}">
    {{ csrf_field() }}

    <input type="hidden" name="file_id" value="{{ $item->id }}" />
    <input type="hidden" name="id" value="{{ $id }}" />
    <input type="hidden" name="type" value="{{ $type }}" />

    <button type="submit" class="btn btn-default" title="@lang('gallery.restore')">
        <i class="fa fa-recycle" aria-hidden="true"></i>
    </button>
</form>