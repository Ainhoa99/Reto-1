jQuery(document).ready(function ($) {
    
    /* Menu navegacion desplegable - evento onclick */
    
    $('#btn-nav').on('click', function () {
        $('#menu-nav').toggleClass('ocultar');
    });

    $('#btn-buscador').on('click', function () {
        $('#buscador').toggleClass('ocultar');
    });

    /* Efecto del botón menú navegacion - evento onclick */

    $('#btn-nav').on('click', function () {
        $('html').toggleClass('efecto-btn');
    });
    
    
   
});