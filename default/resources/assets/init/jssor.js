var jssor_slider = new $JssorSlider$("jssor_slider", {
    $PlayOrientation: 1,
    $LazyLoading: 0,
    $DragOrientation: 1,                            //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)

    $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
        $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
        $ChanceToShow: 2,                           //[Required] 0 Never, 1 Mouse Over, 2 Always
        $Steps: 1                                   //[Optional] Steps to go for each navigation request, default value is 1
    },

    $ThumbnailNavigatorOptions: {                   //[Optional] Options to specify and enable thumbnail navigator or not
        $Class: $JssorThumbnailNavigator$,          //[Required] Class to create thumbnail navigator instance
        $ChanceToShow: 2,                           //[Required] 0 Never, 1 Mouse Over, 2 Always
        $ActionMode: 1,                             //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
        $SpacingY: 16,                              //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
        $Rows: 1,                                   //[Optional] Number of pieces to display, default value is 1
        $Align: 124,                                //[Optional] The offset position to park thumbnail
        $Orientation: 2
    },
});

function scaleSlider() {
    jssor_slider.$ScaleWidth($("#jssor_slider").parent().width());
}

$(window)
    .bind("load", scaleSlider)                   	// Готовность документа
    .bind("resize", scaleSlider)                 	// Изменение высоты окна
;