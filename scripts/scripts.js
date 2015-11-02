$(document).ready(function(){
    var select = $('.stoy').data('url');
    
    switch (select) {
        case 'index':
            console.log('index');
            $('.content').css('width', '615px');
            $('.footer').css('width', '615px');
            $('.body').css('background', 'url(./images/index_sheet.png) no-repeat center');
            $('.tag_link').css('margin-top', '-12px');
            $('.tag_link').css('margin-right', '-2px');
            break;
        case 'nuevo_correo':
            $('body').css('background', 'url(./images/background.jpg)repeat-y top center');
            $('.body').css('display', 'block');
            $('.body').css('background', 'url(./images/sheet_long_2.png) repeat-y center');
            $('.body').css('overflow', 'visible');
            $('.footer').css('position', 'absolute');
            $('.footer').css('margin', 'auto');
            $('.footer').css('width', '100%');
            $('.tag.link').css('margin-top','391px');
            $('.tag.link').css('margin-right','-464px');
            $('.content').css('width','1000px');
            $('.content').css('height','auto');
            $('.content').css('min-height','600px');
            $('.content').css('overflow','hidden');
            break;
        case 'r_pass':
            $('.form_configurar').css('background-image', 'url(./images/back_form_repass.png)');
            $('.titulo').css('padding-top', '15px');
            break;  
        case 'cambiar':
            $('.form_configurar').css('background-image', 'url(./images/back_form_cam.png)');
            break;  
    }

    $(".hoja_izquierda").animate({
        top: "330px"
    }, 4000);
    
    $(".hoja_derecha").animate({
        top: "580px"
    }, 4000);
    
    $(".hoja_derecha_l").animate({
        top: "504px"
    }, 4000);
    
    $(".hoja_izquierda_l").animate({
        top: "335px"
    }, 4000);
     console.log('animacion');
});

