/*
 * ---------------------------------------------
 * Прибиваем подвал к полу на коротких страницах
 * ---------------------------------------------
 */

function footerToBottom() {                         // Функция
    var footer = $(".footer_wrap"),
        difference = $("body").outerHeight(true) - $(window).height()
    ;

    if (footer.hasClass("bottom_fixed") && !$(".navbar-toggle").is(":visible")) {
        difference += footer.outerHeight(true);
    }

    if (difference > 0) {
        footer.removeClass("bottom_fixed");
    }
    else {
        footer.addClass("bottom_fixed");
    }
}

$(window)
    .bind("load", footerToBottom)                   // Готовность документа
    .bind("resize", footerToBottom)                 // Изменение высоты окна
;

var footer_timeout;

$(document).bind("DOMSubtreeModified", function(){  // Изменение высоты textarea, догрузка элементов аяксом
    if (typeof footer_timeout !== "undefined") { clearTimeout(footer_timeout); }

    footer_timeout = setTimeout(function () {
        footerToBottom();
    }, 300);
});
