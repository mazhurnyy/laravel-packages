/*
 * -------------------
 * Кнопка показать ещё
 * -------------------
 */

$("#catalog_more").click(function() {

    var more = $(this),
        load = $("#catalog_more_load"),
        start = $("#catalog .i").size(),
        all = +$("#all").text();

    more.addClass("hidden");
    load.removeClass("hidden");

    $.ajax({
        type: "post",
        url: String(window.location),
        cache: false,
        data: { start: start },
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
        success: function(msg) {
            $("#catalog").append(msg);
            load.addClass("hidden");

            start = +$("#catalog .i").size();

            if (start < all) {
                more.removeClass("hidden");
            }
        }
    });
});