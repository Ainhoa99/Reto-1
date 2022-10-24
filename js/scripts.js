jQuery(document).ready(function ($) {
    
    /* Menu navegacion desplegable  */
    
    $('#btn-nav').on('click', function () {
        $('#menu-nav').toggleClass('ocultar');
    });
    
    /* Buscador */

    $('#btn-buscador').on('click', function () {
        $('#buscador').toggleClass('ocultar');
    });

    /* Efecto del botón menú navegacion  */

    $('#btn-nav').on('click', function () {
        $('html').toggleClass('efecto-btn');
    });
    
    /* Ficha técnica desplegable */
    
    
    $('#btn-fichatecnica').on('click', function () {
        $('#contenido-fichatecnica').toggleClass('ocultar');
    });
    
    $('#btn-fichatecnica').append('<i class="fas fa-angle-down"></i>');
    
    $('#btn-fichatecnica').on('click', function(){
        $(this).find('i').toggleClass('fa-angle-down');
        $(this).find('i').toggleClass('fa-angle-up');
    }); 
   
});