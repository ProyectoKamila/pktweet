<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>" />
        <meta charset="utf-8">
        <title>Pktweet Proyecto Kamila</title>
        <meta name="description" content="Acceso de clientes, Agencia web proyecto kamila, servicios globales, social media, marketing, community manager" />
        <meta name="keywords" content="Acceso de clientes, Agencia web proyecto kamila, servicios globales, social media, marketing, community manager" />
        <meta name="viewport" content="initial-scale=1">

        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://pktweet.proyectokamila.com/" />
        <meta property="og:title" content="Pktweet de Proyecto kamila" />
        <meta property="og:description" content="Sistema de Gestion de Redes Sociales. Programa tus redes Sociales para impulsar el crecimiento de tu marca." />
        <meta property="og:image" content="http://pktweet.proyectokamila.com/img/pktweet.png" />

        <link rel="shortcut icon" id="favicon" href="http://www.proyectokamila.com/favicon.png"> 
        <link href='./css/account/style.css' rel='stylesheet' type='text/css'>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="scripts/main.js"></script>
    </head>

    <body>
        <script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-55295300-1', 'auto');
 ga('send', 'pageview');

</script>
        <div class="container" id="principal">
            <div class="login">
                <div class="logo_vert"></div>
                <div class="form">
                    <h2>PkTweet</h2>
                    <!--<p class="error">Error al ingresar usuario/contrase&ntilde;a</p>-->
                    <!--                    <form>
                                            <input type="text" name="user" class="text user texto" placeholder=" | Correo Electronico" required="" autocomplete="off">
                                            <input type="password" name="pass" class="text pass texto" placeholder=" | Contraseña" required="">
                                            <input type="submit" class="enviar" value="Iniciar Sesion"/>    
                                        </form>
                                        <a href="http://account.proyectokamila.com/restablecer.php" class="opcion">Olvide mi contrase&ntilde;a</a>
                                        <a href="http://www.pkcut.net/l/2eypscs" class="opcion registrarme">Registrarme</a>-->
                    <a href="http://pkaccount.com/p/?url=7" class="enviar">Iniciar sesi&oacute;n</a>
                    <a href="http://pkaccount.com/p/add.php?url=7" class="opcion registrarme s">Reg&iacute;strate</a>

                </div>
            </div>
            <div class="informative_flotante_derecho">
                <div id="close_up_left" class="close_up_left">
                    <strong>X</strong>  Ocultar
                </div>
                <div class="mini_information">
                    <h2>PkTweet Proyecto Kamila</h2>
            <iframe width="300" height="275" src="//www.youtube.com/embed/wfaxRtTHbtA" frameborder="0" allowfullscreen></iframe>
                  
                    <h4><strong>Perfiles de Twitter Activos: </strong></h4>
                    <div style="text-align: center;">
                        <span style="background: #c52023;color: white;padding: 5px;border-radius: 5px;font-weight: bold;font-variant: normal;font-size: 2em;"><?php if ($this->data != null) {
    echo $this->data['count'][0]['count(*)'];
} else {
    echo "0";
} ?></span>                    </div>
                </div>
            </div>
        </div>
    </body>

</html>