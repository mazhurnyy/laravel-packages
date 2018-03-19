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
    .load(function() {
        footerToBottom();                           // Готовность документа
    })
    .resize(function () {                           // Изменение высоты окна
        footerToBottom();
    })
;

$(document).bind("DOMSubtreeModified", function(){  // Изменение высоты textarea, догрузка элементов аяксом
    setTimeout(function () {
        footerToBottom();
    }, 300);
});