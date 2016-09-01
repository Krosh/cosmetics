$(document).ready(
    function () {
        $('.camera_wrap').each(function () {
            $(this).camera(
                {
                    playPause: false,
                    height: $(this).data("height") > 0 ? $(this).data("height").toString() : "auto",
                }
            )
        });

        $('#my-slider').unslider({
            autoplay: true,
            arrows: false,
            delay: 5200,
            speed: 2250
        });
    }
)