$(document).ready(
    function () {
        jQuery('.camera_wrap').camera(
            {
                playPause: false,
            }
        );
        $('#my-slider').unslider({
            autoplay: true,
            arrows: false,
            delay: 5200,
            speed: 2250
        });
    }
)