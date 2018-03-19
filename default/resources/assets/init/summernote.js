/*
 * ------
 * Editor
 * ------
 */

if (
       navigator.userAgent.indexOf("MSIE") === -1
    && navigator.userAgent.indexOf("Android 2.") === -1
    && navigator.userAgent.indexOf("Android 3.") === -1
    && navigator.userAgent.indexOf("Opera Mini") === -1
    || navigator.userAgent.indexOf("MSIE 10.") > -1
) {
    var editor = $(".summernote");

    editor.html(editor.html().trim());
    editor.parent().find("textarea").addClass("hidden");

    editor.summernote({
        minHeight: 200,
        lang: "ru-RU",
        toolbar: [
            /*['fontsize', ['fontsize']],*/
            ["style", ["bold", "italic", "underline"]],
            ["air", ["ul", "ol"]],
        ],
        callbacks: {
            onChange: function (contents) {

                if (contents.indexOf("<p>") !== 0 && contents.indexOf("<ul>") !== 0 && contents.indexOf("<ol>") !== 0) {
                    contents = "<p>" + contents + "</p>";
                }

                $(this).parent().find("textarea").html(contents);
                $(this).parent().find("textarea").change();
            }
        }
    });
}