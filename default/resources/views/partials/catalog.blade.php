{{-- Универсальный каталог --}}

@isset($catalog)
    @include('partials.catalog.filters')

    @if (count($catalog['results']) > 0)

        @if ($catalog['type'] == 'order')

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><strong>@lang('headers.order.order')</strong></th>
                            <th><strong>@lang('headers.order.date')</strong></th>
                            <th><strong>@lang('headers.order.status')</strong></th>
                            <th><strong>@lang('headers.order.sum')</strong></th>
                        </tr>
                    </thead>
                    <tbody id="catalog">
                        @include('partials.catalog.cards')
                    </tbody>
                </table>
            </div>

        @else

            <div class="row mb_base" id="catalog">
                @include('partials.catalog.cards')
            </div>

        @endif

        @include('partials.catalog.more')

    @elseif (!empty(Filters::getFilters()))

        <div class="alert alert-danger" role="alert">
            @lang('status.sample_null')
        </div>

    @endif
@endisset