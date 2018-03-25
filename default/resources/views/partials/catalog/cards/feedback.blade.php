{{-- Карточка обратной связи --}}

<div class="col-xs-12 i">
    <div class="card">

        <div class="row">
                <div class="col-xs-11">

                    <small class="text-muted">{{ $item->created_at }}</small>
                    <div class="paragraph_fix"></div>

                    <div class="well">
                        {!! $item->message !!}
                        <div class="paragraph_fix"></div>
                    </div>

                </div>
            @if (!empty($item->answer))
                <div class="col-xs-offset-1 col-xs-11">

                    <small class="text-muted">{{ $item->updated_at }}</small>
                    <div class="paragraph_fix"></div>

                    <div class="well">
                        {!! $item->answer !!}
                        <div class="paragraph_fix"></div>
                    </div>

                </div>
            @endif
        </div>

    </div>
</div>