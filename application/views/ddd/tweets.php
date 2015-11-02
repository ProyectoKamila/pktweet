<?
//$tex = $this->data['tweet'];
//if (isset($tex)) {
//    foreach ($tex as $t) {
//        $id = $t['id_twett'];
//        $hab = $t['habilitar'];
//        echo $t['posicion'] . "  " . $t['texto'] . " <a onclick='editar($id)' href='controller/lista_ciclica#editweet'>editar</a>
//                <a href='javascript:eliminar($id)'> Eliminar </a>
//                <a href='javascript:habilitar($id,$hab)'>";
//        if ($hab === '1') {
//            echo "Deshabilitar";
//        } else {
//            echo "Habilitar";
//        } echo" </a><br>";
//    }
//}
?>
<<<<<<< .mine
<? $tex = $this->data['tweet']; ?>
<? if (isset($tex)) { ?>
    <? foreach ($tex as $t) { ?>
        <? $id = $t['id_twett']; ?>
        <? $hab = $t['habilitar']; ?>
        <? ?>
        <? ?>
        <article class="togg-article elim<?= $id; ?>" id="togg-article0">
            <div class="div">
                <div class="twwet-text">
                    <div class="header">
=======
       <? $tex = $this->data['tweet']; ?>
        <? // debug($tex); 
 if ($tex == 'EMPTY'){
     echo "prueba";
 }else{
        if (isset($tex)) { ?>
            <? foreach ($tex as $t) { ?>
                <? $id = $t['id_twett']; ?>
                <? $hab = $t['habilitar']; ?>
                <? ?>
                <? ?>
                <article class="togg-article elim<?= $id;?>" id="togg-article0">
                    <div class="div">
                        <div class="twwet-text">
                            <div class="header">
>>>>>>> .r36
        <!--                        <time>
                            <a href="">5m</a>
                        </time>-->
                        <a class="account-linck" href="">
                            <div  class="twwet-img">
                                <img src="./img/pf.png"/>
                            </div>
                            <div class="twwet-name">
                                <span class="name">
                                    <b>Juan C Figueroa M</b>
                                </span>
                                <span class="user">@jfigueroaubv</span>
                            </div>
                            <!--<p class="twwet-text-p">Haciendo pruebas de tweet automaticos en el nuevo kapptweet de <a class="url" href="https://twitter.com/Proyectokmila/">@Proyectokmila</a><a class="url" href="https://twitter.com/hashtag/UnaVidaPk?src=hash"> #UnaVidaPk</a></p>-->
                            <p class="twwet-text-p" id=""><?= $t['texto'] ?></p>

                            <!--                            <footer class="twwet-text-footer">
                                                            <a class="url" href="">Detalle</a>
                                                        </footer>-->
                        </a>
                        <p style="text-align: right;">
                            <span id="pktweet" style="float: left;"></span>
                        <query id="<?= $id ?>">
                            <? if ($hab === '1') { ?>
                                <a href="javascript:habilitar(<?= $id . ',' . $hab ?>)"class="icon icon-x"></a>
                                <!--echo "Deshabilitar";-->

                            <? } else { ?>
                                <!--echo "Habilitar";-->
                                <a href="javascript:habilitar(<?= $id . ',' . $hab ?>)"class="icon icon-check"></a>

                            <? } ?>
                        </query>
                        <elim class="elim2<?= $id ?>">
                            <a href="javascript:eliminar(<?= $id ?>)"class="icon icon-erase"></a>
                        </elim>
                        <a onclick="editar(<?= $id ?>)" class="icon icon-pencil" href="./#editweet"></a>
                        </p>

                    </div>
<<<<<<< .mine
                </div>
            </div>
        </article>
        <?
    }
}
?>=======
                </article>
            <?
            }
            }
 }
            ?>>>>>>>> .r36
