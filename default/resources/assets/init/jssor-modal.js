/*
 * ------------------------------
 * Слайдер JSSOR в модальном окне
 * ------------------------------
 */

$("#modal").on("shown.bs.modal", function () {
    scaleSliderMd();
});

jssor_sm.$On($JssorSlider$.$EVT_POSITION_CHANGE, function (pos, fromPos, virtualPos, virtualFromPos) {
    jssor_md.$GoTo(virtualPos);
});