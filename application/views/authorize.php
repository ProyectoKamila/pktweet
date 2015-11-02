<div class="content">
    <div class="authorize">
    <div class="content_authorize">
<!--        <div class="logo_authorize">
            <img src="" alt="pk tweet"/>
        </div>-->
        <div class="description_authorize clear">
             <h1 class="titulo">Crea <strong>campa&ntilde;as de Marketing</strong></h1>
             <p ><strong>herramienta para community manager</strong>, complemento perfecto para la gestion de <strong>Social Media</strong>...</p>
             <h2>Eres <strong>Community Manager</strong>:</h2>
             <p>Quieres Gestionar todas las <strong>cuantas de Twitter</strong> que quieras...</p>
                <p>Quieres programar los <strong>Twitter automaticamente</strong> para que se publiquensolos<!-- <strong>seguidores</strong>-->...</p>
                <p>Empieza ahora, <strong>Gratis</strong> </p>
                <a href="./process">
                    <div class="button">
                        <h3>Iniciar sesión con Twitter</h3><img src="./img/icon_01.png" alt="logo proyecto kamila"/>
                    </div>
                </a>
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

