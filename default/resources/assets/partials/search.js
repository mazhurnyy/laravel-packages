/*
 * -------------
 * Быстрый поиск
 * -------------
 */

var search_timeout, search_ajax;

$(document)
    .ready(function () {        // Вид лупы и крестика по готовности документа

        var text_obj = $("#search_text"),
            submit_obj = $("#search_submit"),
            clean_obj = $("#search_clean")
        ;

        if (text_obj.val().length >= 2) {
            submit_obj.removeClass("disabled");
        }
        else {
            submit_obj.addClass("disabled");
        }

        if (text_obj.val().length >= 1) {
            clean_obj.removeClass("hidden");
        }
        else {
            clean_obj.addClass("hidden");
        }
    })
    .click(function (e) {      // Клик вне блока результатов и формы поиска на больших диагоналях

        var form_obj = $("#search_form"),
            result_obj = $("#search_result");

        if (result_obj.css("position") === "absolute" && !result_obj.hasClass("hidden")) {

            var find = false;

            $(e.target).parents().each(function () {

                if ($(this).is(form_obj)) {			 // Ищем в родителях форму поиска
                    find = true;
                    return false;
                }
            });

            if (!find) {
                result_obj.addClass("hidden");
            }
        }
    })
;
$("body")
    .on("click", "#search_clean", function() {       //	Клик на Крестик - очистка строки поиска

        var text_obj = $("#search_text");

        $("#search_submit").addClass("disabled");
        $("#search_result").addClass("hidden");
        $("#search_clean").addClass("hidden");

        text_obj.attr("value", "").val("").focus();
    })
    .on("keyup", "#search_text", function() {       // Активность в строке быстрого поиска

        if (typeof search_timeout !== "undefined") { clearTimeout(search_timeout); }

        if (typeof search_ajax !== "undefined") { search_ajax.abort(); }

        var text_obj = $("#search_text"),
            submit_obj = $("#search_submit"),
            result_obj = $("#search_result"),
            clean_obj = $("#search_clean"),
            text = text_obj.val();

        text_obj.attr("value", text);               // Запоминаем значение для перемещения формы

        if (text.length >= 2) {
            var loading = $("#search_loading").html();

            submit_obj.removeClass("disabled");
            result_obj.html(loading).removeClass("hidden");

            search_timeout = setTimeout(function() {

                search_ajax = $.ajax({
                    type: "post",
                    url: "/search/fast",
                    cache: false,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
                    },
                    data: {
                        text: text
                    },
                    success: function(msg) {
                        result_obj.html(msg);
                    }
                });
            }, 700);
        }
        else {
            submit_obj.addClass("disabled");
            result_obj.addClass("hidden");
        }

        if (text.length >= 1) {
            clean_obj.removeClass("hidden");
        }
        else {
            clean_obj.addClass("hidden");
        }
    })
    .on("submit", "#search_form", function(e) {     // Отправка формы

        var text = $("#search_text");

        if (text.val().length < 2) {
            e.preventDefault();
            text.focus();
        }
    })
;