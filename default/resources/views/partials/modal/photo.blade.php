{{-- Модальное окно для одной фотографии --}}

@push('scripts')
    <script src="{{ mix('frontend/plugins/bootstrap-v3/modal.js') }}" defer></script>
    <script src="{{ mix('frontend/partials/modal-photo.js') }}" defer></script>
@endpush

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="photoModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('headers.button.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="photoModal">{{ $title }}</h4>
            </div>
            <div class="modal-body">
                <img src="#"
                     alt="{{ $title }}"
                     class="img-responsive"
                />
            </div>
        </div>
    </div>
</div>