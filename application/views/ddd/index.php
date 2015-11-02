<? ?>
<? if (isset($this->data)) { ?>
<? $cuentas_t = $this->data['cuentas_t']; ?>
    <? // debug($this->data['cuentas_t']);          ?>
    <? // session_destroy();          ?>
    <? // debug($_SESSION);         ?>

    <div class="content">
        <? // $this->load->view('pkmenu'); ?>

        <div class="twwet-toggle" id="target" >
            <h1>Configuración</h1>
            <div class="twwet-toggle-img">
                <a class="icon icon-user-add" href="./controller/process"></a>
                <a class="icon icon-pencil" href=""></a>
                <!--                    <div class="icon icon-user-add"></div>-->
            </div>

            <h1>Cuentas de Twitter</h1>
                    <? $cuentas = $this->data['ctas']; ?>
            <?if (isset($cuentas_t)) {?>
            <?foreach ($cuentas_t as $c) {?>
            <?$id = $c['id_cuenta'];?>
            <?$nombre = "@".$c['screen_name'];?>
            
            <a href="./lista_ciclica/<?=$id;?>">
                <div class="twwet-toggle-img">
<<<<<<< .mine
                    <img src="./img/pf.png"/>
                    <?=$nombre?>
=======
                    <? if (isset($cuentas)) {
                    foreach ($cuentas as $c) {
                    $id = $c['id_cuenta'];
                    $nombre = $c['screen_name'];
                    ?><img src="./img/pf.png"/><?
                    echo " <a href='./lista_ciclica/" . $id . "'>" . $nombre . "</a><br>"; }}?>
                    
                    
                    
                    
                    <!--<img src="./img/pf.png"/>-->
                    <? // debug($this->data['ctas'])?>
                    <? // $this->load->view('cuentas')?>
>>>>>>> .r36
                </div>
            </a>
            <?}?>
            <?}?>
        </div>
        <div class="columns-content">
            <? $this->load->view("kapp-tweet/content"); ?>

        </div>
    </div>
    <?
} else {
    
}
?>
<? // $this->load->view('footer') ?>
<div id="editweet" class="modalDialog">
    <div >
        <a href="./#close" title="Close" class="close">X</a>
        <div class="contenidomodal" id="contenidomodal" style="width: auto; height: auto; max-height: 100%; max-width: 100%;">
        </div>
    </div>
</div>
<!--141013510-->
