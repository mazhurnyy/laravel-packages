/*
 * -------------------
 * Скролл показать ещё
 * -------------------
 */

var loading = $("#catalog_more_load"),
    all_obj = $("#all"),
    all = +all_obj.text();

function catalogLoad (scroll) {
    var start = $("#catalog .i").size(),
        page = +all_obj.attr("data-page") + 1;

    if (scroll && loading.hasClass("hidden") && start < all) {
        $.ajax({
            type: "post",
            url: String(window.location),
            cache: false,
            data: { start: start, page: page },
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
            beforeSend: function() {
                loading.removeClass("hidden");
            },
            success: function(msg) {
                all_obj.attr("data-page", page);
                loading.addClass("hidden");
                $("#catalog").append(msg);

                catalogLoad($(".footer_wrap").hasClass("bottom_fixed"));
            }
        });
    }
}

if ($("i").is("#catalog_more_load")) {
    $(window)
        .load(function() {
            catalogLoad($(".footer_wrap").hasClass("bottom_fixed"));
        })
        .resize(function () {
            catalogLoad($(".footer_wrap").hasClass("bottom_fixed"));
        })
        .scroll(function() {
            catalogLoad($(window).scrollTop() >= (loading.parent().offset().top - $(window).height()));
        })
    ;
}