var gallery_filter_ajax;

$("body")
/*
* -----------------------------------
* Красивая кнопка прикрепления слайда
* -----------------------------------
*/
    .on("change", "[type=file]", function() {
        $("#form_add").submit();
        $(".add_submit").addClass("hidden");
        $(".add_spinner").removeClass("hidden");
    })
/*
 * ----------------------
 * Слайд в модальное окно
 * ----------------------
 */
    .on("click", ".c_zoom", function() {
        $("#current_image").attr("src", $(this).data("src")).attr("alt", $(this).data("alt"));
        $("#current_link").text($(this).data("src"));
    })
/*
 * -------
 * Фильтры
 * -------
 */
    .on("click", ".nav-pills>li", function() {
        if (!$(this).hasClass("active")) {

            // Шлем значение фильтра на сервер в сессию
            if (typeof gallery_filter_ajax !== "undefined") { gallery_filter_ajax.abort(); }

            gallery_filter_ajax = $.ajax({
                type: "post",
                url: $(".nav-pills").data("action"),
                cache: false,
                data: {filter: $(this).data("filter")},
                headers: {"X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")},
            });

            // Меняем видимость карточек
            if ($(this).data("filter") === 'actual') {
                $(".actual").removeClass("hidden");
                $(".deleted").addClass("hidden");
            }
            else if ($(this).data("filter") === 'deleted') {
                $(".actual").addClass("hidden");
                $(".deleted").removeClass("hidden");
            }
            else {
                $(".actual").removeClass("hidden");
                $(".deleted").removeClass("hidden");
            }

            // Переключаем кнопки фильтров
            var old_obj = $(".nav-pills>li.active"),
                new_obj = $(this),
                old_text = old_obj.find("h2").text(),
                new_text = $(this).find("a").text()
            ;

            old_obj.removeClass("active").html('<a href="#">' + old_text + '</a>');
            new_obj.addClass("active").html('<h2>' + new_text + '</h2>');
        }
    })
;