/*
 * ------------------------------
 * Переключатель видимости пароля
 * ------------------------------
 */

$("#btn_pwd_show").click(function() {

    $(this).addClass("hidden");
    $("#btn_pwd_hide").removeClass("hidden");

    $(".password").attr("type", "text");
});

$("#btn_pwd_hide").click(function() {

    $(this).addClass("hidden");
    $("#btn_pwd_show").removeClass("hidden");

    $(".password").attr("type", "password");
});