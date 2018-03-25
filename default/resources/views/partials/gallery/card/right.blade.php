{{-- Кнопка вправо --}}

@if ($item->order < $last)
    <form method="post" action="{{ route('file.order') }}">
        {{ csrf_field() }}

        <input type="hidden" name="file_id" value="{{ $item->id }}" />
        <input type="hidden" name="id" value="{{ $id }}" />
        <input type="hidden" name="type" value="{{ $type }}" />
        <input type="hidden" name="direction" value="right" />

        <button type="submit" class="btn btn-default" title="@lang('gallery.right')">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </button>
    </form>
@else
    <button type="button" class="btn btn-default disabled" title="@lang('gallery.right')">
        <i class="fa  fa-chevron-right" aria-hidden="true"></i>
    </button>
@endif