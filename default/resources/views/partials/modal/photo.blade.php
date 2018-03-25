{{-- Модальное окно для одной фотографии --}}

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="photoModal">
    <div class="modal-dialog modal_souvenir" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('headers.button.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="photoModal">@lang('headers.basket.photo')</h4>
            </div>
            <div class="modal-body">
                <img src="#"
                     alt="@lang('headers.basket.photo')"
                     class="img-responsive"
                     height="600"
                     id="photo"
                />
            </div>
        </div>
    </div>
</div>