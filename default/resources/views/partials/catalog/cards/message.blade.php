{{-- Карточка обратной связи --}}

<div class="col-xs-12 i">
    <div class="card card_message">

            <div class="row">
                <div class="col-xs-3 col-sm-2 text-center">

                    <div class="paragraph_fix"></div>
                    <i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i>

                </div>
                <div class="col-xs-9 col-sm-10">

                    <small class="text-muted">{{ $item->created_at->format('d.m.Y, H:i') }}</small>
                    <div class="paragraph_fix"></div>

                    {!! $item->message !!}

                </div>
            </div>

        @if (!empty($item->answer))
            <div class="row">
                <div class="col-xs-3 col-sm-2 text-center">

                    <div class="paragraph_fix"></div>
                    <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>

                </div>
                <div class="col-xs-9 col-sm-10">

                    <small class="text-muted">{{ $item->updated_at->format('d.m.Y, H:i') }}</small>
                    <div class="paragraph_fix"></div>

                    {!! $item->answer !!}

                </div>
            </div>
        @endif

    </div>
</div>