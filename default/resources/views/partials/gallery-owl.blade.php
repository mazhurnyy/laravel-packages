{{-- Управление изображениями галереи --}}

@push('footer-scripts')
    <link rel="stylesheet" href="{{ mix('frontend/styles/gallery.css') }}" />
    <link rel="stylesheet" href="{{ mix('frontend/styles/gallery-owl.css') }}" />
    <script src="{{ mix('frontend/partials/gallery.js') }}" defer></script>
    <script>{{-- запоминаем вкладку --}}
        $("a[role=tab]").click(function () {
            localStorage.setItem("tab-" + window.location.href, $(this).attr("href"));
        });

        $("a[href='" + localStorage.getItem("tab-" + window.location.href) + "']").click();
    </script>
@endpush

<div id="gallery-owl">
    @include('mazhurnyy::partials.gallery.filter')

    <div class="row">
        @foreach ($results as $item)
            @include('mazhurnyy::partials.gallery.card')
        @endforeach
    </div>

    @include('mazhurnyy::partials.gallery.errors')
    @include('mazhurnyy::partials.gallery.add')
    @include('mazhurnyy::partials.gallery.modal')
</div>