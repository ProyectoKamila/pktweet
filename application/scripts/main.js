$(window).load(function() {
    $('#principal').css('background-image', 'url(img/mapa2.png)');
    
    $('#close_up_left').click(function() {
        $('div.informative_flotante_derecho').css('width', '0px');
        $('div.informative_flotante_derecho').css('height', '0px');
    });
});


