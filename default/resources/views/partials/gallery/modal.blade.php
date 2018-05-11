{{-- Модальное окно с большим изображением --}}

<div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="imageModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('gallery.dismiss')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="imageModal">@lang('gallery.image')</h4>
            </div>
            <div class="modal-body">
                <img src="#"
                     alt="@lang('gallery.image')"
                     class="img-responsive mb_half"
                />

                @if (Auth::user()->isModerator())
                    <div id="current_link">#</div>
                @endif
            </div>
        </div>
    </div>
</div>