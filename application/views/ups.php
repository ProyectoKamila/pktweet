<div class="content">
    <div class="authorize">
    <div class="content_authorize">
<!--        <div class="logo_authorize">
            <img src="" alt="pk tweet"/>
        </div>-->
        <div class="description_authorize clear">
             <h1 class="titulo">Ups!</h1>
             <h2>Sentimos las molestias justo ahora estamos haciendo mejoras a la plataforma. Te enviaremos un correo para avisarte cuando estemos listo para ti.</h2>
<!--                <a href="http://account.proyectokamila.com/p/?url=7">
                    <div class="button" style="width: 250px !important;">
                        <h3>Iniciar sesión con</h3><img src="./img/icon_01.png" alt="logo proyecto kamila"/>
                    </div>
                </a>-->
        </div>
        
    </div>
<!--<a href="./process">Autorizar</a>-->
</div>
        <div class="authorize_footer">
            <div class="clear">
                <h2>
                    <strong>Perfiles de Twitter Activos: </strong> <span><?=$this->data['count'][0]['count(*)'];?></span>
                </h2>
            </div>
        </div>
</div>

<? $this->load->view('footer') ?>

