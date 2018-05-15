{{-- Слайдер маленький + большой в модали --}}

<div class="c_zoom mb_base">
    @include('mazhurnyy::partials.jssor.sm')
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="jssorModal">
    <div class="modal-dialog jssor_modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('button.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="jssorModal">{{ $title }}</h4>
            </div>
            <div class="modal-body">
                @include('mazhurnyy::partials.jssor.md')
            </div>
        </div>
    </div>
</div>