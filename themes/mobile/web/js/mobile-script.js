$(document).ready(function () {
        (function ($) {
            // Create a new instance of Slidebars
            var controller = new slidebars();
            // Initialize Slidebars
            controller.init();
            $( '.js-open-mmenu-overlay' ).on( 'click', function ( event ) {
                event.preventDefault();
                event.stopPropagation();
                controller.open( 'mmenu-overlay' );
            } );

            $( '.js-toggle-mmenu-overlay' ).on( 'click', function ( event ) {
                event.preventDefault();
                event.stopPropagation();
                controller.toggle( 'mmenu-overlay' );
            } );

            $( '.js-close-mmenu-overlay' ).on( 'click', function ( event ) {
                event.preventDefault();
                event.stopPropagation();
                controller.close( 'mmenu-overlay' );
            } );
        })(jQuery);
    }
)