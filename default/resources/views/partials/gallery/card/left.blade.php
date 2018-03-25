{{-- Кнопка влево --}}

@if ($item->order > $first)
    <form method="post" action="{{ route('file.order') }}">
        {{ csrf_field() }}

        <input type="hidden" name="file_id" value="{{ $item->id }}" />
        <input type="hidden" name="id" value="{{ $id }}" />
        <input type="hidden" name="type" value="{{ $type }}" />
        <input type="hidden" name="direction" value="left" />

        <button type="submit" class="btn btn-default" title="@lang('gallery.left')">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </button>
    </form>
@else
    <button type="button" class="btn btn-default disabled" title="@lang('gallery.left')">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </button>
@endif