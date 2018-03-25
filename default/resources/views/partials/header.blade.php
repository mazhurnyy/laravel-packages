{{-- Верхнее узкое меню + логотип, контакты + строка быстрого поиска + широкое меню --}}

<header>

    <div class="menu_narrow mb_base">
        <nav class="container">
            <ul class="list-inline pull-right">
                @include('partials.header.narrow.basket')
                @include('partials.header.narrow.language')
                @include('partials.header.narrow.logon')
            </ul>
        </nav>
    </div>

    <div class="paragraph_fix hidden-xs"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('partials.header.light')
            </div>
            <div class="col-md-4">
                @include('partials.search.form')
            </div>
        </div>
    </div>

    <div class="paragraph_fix hidden-xs"></div>

    <nav class="navbar navbar-inverse">
        <div class="container">
            @include('partials.header.wide')
        </div>
    </nav>

    <div class="collapse" id="contactsWide">
        <div class="container mb_base">
            @include('partials.phones.row')
        </div>
    </div>

</header>