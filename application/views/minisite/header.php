<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>" />
        <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="./css/minisite/style.css"/>
        <title>PKtweet</title>
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-55295300-1', 'auto');
            ga('send', 'pageview');

        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.subir').click(function() {
                    $('html, body').animate({scrollTop: '0px'}, 1000);
                    return false;
                });
            });
        </script>

    </head>
    <body>
        <div class="header1">
            <div class="header2">
                <!--                <div class="header3">
                                    <p><a href="" class="link1"><img src="./imagenes/user.png" alt="">Acceso de clientes  </a></p>
                                    http://pkaccount.com/p/?url=7
                                    <a href="http://pkaccount.com/p/?url=7" class="boton" style="display: block;text-decoration: none;">Inicia Sesi&oacute;n</a>
                                </div>-->
                <div>
                    <ul class="res der">
                        <li class="pkclick"> <a href="http://pkclick.com/company/proyecto-kamila"><img src="imagenes/pkclick.png" alt=""></a></li>
                        <li class="twitter"><a href="http://twitter.com/ProyectoKamila"><img src="imagenes/twitter.png" alt=""></a></li>
                        <li class="facebook"><a href="https://www.facebook.com/Proyectokmila"><img src="imagenes/facebook.png" alt=""></a></li>
                        <li class="googleplus"><a href="https://plus.google.com/b/114485597925538235933/114485597925538235933/posts"><img src="imagenes/googleplus.png" alt=""></a></li>
                        <li class="instagram"><a href="http://instagram.com/proyectokamila"><img src="imagenes/instagram.png" alt=""></a></li>
                        <!--<li class="linkedin"><a href=""><img src="imagenes/linkedin.png" alt=""></a></li>-->
                        <!--<li class="pinterest"><a href=""><img src="imagenes/pinterest.png" alt=""></a></li>-->
                        <li> <a class="enviar"href="http://pkaccount.com/p/?url=7">Inicia Sesi&oacute;n</a></li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="header4"> 
            <img src="./imagenes/logo 2.png" alt="" class="header5">
            <div class="derr">
                <ul class="list">
                    <li><a href="">NOSOTROS</a></li>
                    <li><a href="">PRODUCTOS Y SERVICIOS</a></li>
                    <li><a href="">BLOG</a></li>
                    <li><a href="">SOPORTE</a></li>
                    <li><a href="">CONTACTO</a></li>
                </ul>
            </div>

        </div>
    </body>
</html>