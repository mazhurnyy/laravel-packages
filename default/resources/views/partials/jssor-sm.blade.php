{{-- Слайдер маленький --}}

<div id="jssor_sm" class="jssor_slider jssor_sm">

    {{--#region Loading Screen Begin --}}
    <div data-u="loading" class="jssorl-005-circles jssor_loading">
        <img class="jssor_loading_img" src="{{ asset('frontend/plugins/jssor/circles.svg') }}" />
    </div>
    {{--#endregion Loading Screen End --}}

    {{-- Slides Container Begin --}}
    <div data-u="slides" class="jssor_slides">
        @foreach($slides as $slide)
            <div>
                {{-- todo alt из файлохранилища, name - не локализован, нужен title которого нет --}}
                {{-- todo размеры префиксов tznp и biatron не совпадают --}}
                <img data-u="image" alt="{{ $slide->name }}" data-src2="{{ $slide->src_preview }}"  />
            </div>
        @endforeach
    </div>

    {{--#region Arrow Navigator Skin Begin --}}
    {{-- Help: https://www.jssor.com/development/slider-with-arrow-navigator.html --}}
    <div data-u="arrowleft" class="jssora073 jssor_arrow_left" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
        <svg viewBox="0 0 16000 16000" class="arrow_svg">
            <path class="a" d="M4037.7,8357.3l5891.8,5891.8c100.6,100.6,219.7,150.9,357.3,150.9s256.7-50.3,357.3-150.9 l1318.1-1318.1c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3L7745.9,8000l4216.4-4216.4 c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3l-1318.1-1318.1c-100.6-100.6-219.7-150.9-357.3-150.9 s-256.7,50.3-357.3,150.9L4037.7,7642.7c-100.6,100.6-150.9,219.7-150.9,357.3C3886.8,8137.6,3937.1,8256.7,4037.7,8357.3 L4037.7,8357.3z"></path>
        </svg>
    </div>
    <div data-u="arrowright" class="jssora073 jssor_arrow_right" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
        <svg viewBox="0 0 16000 16000" class="arrow_svg">
            <path class="a" d="M11962.3,8357.3l-5891.8,5891.8c-100.6,100.6-219.7,150.9-357.3,150.9s-256.7-50.3-357.3-150.9 L4037.7,12931c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3L8254.1,8000L4037.7,3783.6 c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3l1318.1-1318.1c100.6-100.6,219.7-150.9,357.3-150.9 s256.7,50.3,357.3,150.9l5891.8,5891.8c100.6,100.6,150.9,219.7,150.9,357.3C12113.2,8137.6,12062.9,8256.7,11962.3,8357.3 L11962.3,8357.3z"></path>
        </svg>
    </div>
    {{--#endregion Arrow Navigator Skin End --}}

    {{--#region Bullet Navigator Skin Begin --}}
    {{-- Help: https://www.jssor.com/development/slider-with-bullet-navigator.html --}}
    <div data-u="navigator" class="jssorb051 jssor_bullets" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
        <div data-u="prototype" class="i jssor_bullet">
            <svg viewBox="0 0 16000 16000" class="bullet_svg">
                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
            </svg>
        </div>
    </div>
    {{--#endregion Bullet Navigator Skin End --}}

</div>