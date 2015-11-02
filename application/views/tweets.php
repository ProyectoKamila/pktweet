<?php $tex = $this->data['tweet']; ?>
<?php
//debug($this->data);
if ($tex == 'EMPTY') {
    echo "prueba";
} else {
    if (isset($tex)) {
        ?>
        <?php foreach ($tex as $t) { ?>
            <?php $id = $t['id_twett']; ?>
            <?php $hab = $t['habilitar']; ?>
            <?php
            require_once('./application/libraries/twitteroauth.php');
            $connection = new TwitterOAuth('F4iItkUoo9No1lY3jb161Galf', 'zT5fn2RfGjG6Z7LDPhirHlicLpmmF0PcfDEEMAg07ytk5gCFVg');
            $urlapi = "statuses/user_timeline.json?screen_name=" . $this->data['screenname'] . "&count=1";
            $tweets = $connection->get("https://api.twitter.com/1.1/" . $urlapi);

            if (is_array($tweets) && is_object($tweets[0]) && isset($tweets[0]) && isset($tweets[0]->user->name)) {
                $this->data['tname'] = $tweets[0]->user->name;
            } else {
                $this->data['tname'] = "";
            }
            if (is_array($tweets) && is_object($tweets[0]) && isset($tweets[0]->user->profile_image_url)) {
                $this->data['timg'] = $tweets[0]->user->profile_image_url;
            } else {
                $this->data['timg'] = "./img/pf.png";
            }
            ?>
            <article class="togg-article elim<?= $id; ?>">
                <div class="div">
                    <div class="twwet-text">
                        <div class="header">
            <!--                        <time>
                                <a href="">5m</a>
                            </time>-->
                            <!--<a class="account-linck" href="">-->
                            <div  class="twwet-img">
                                <img src="<?= $this->data['timg']; ?>"/>
                            </div>
                            <div class="twwet-name">
                                <span class="name">
                                    <b><?= $this->data['tname']; ?></b>
                                </span>
                                <span class="user"> <a target="_blank" href="http://twitter.com/<?= $this->data['screenname'] ?>">@<?= $this->data['screenname'] ?></a></span>
                            </div>
                            <!--<p class="twwet-text-p">Haciendo pruebas de tweet automaticos en el nuevo kapptweet de <a class="url" href="https://twitter.com/Proyectokmila/">@Proyectokmila</a><a class="url" href="https://twitter.com/hashtag/UnaVidaPk?src=hash"> #UnaVidaPk</a></p>-->
                            <p class="twwet-text-p twit<?= $id ?> editint<?= $id ?>" onkeydown="sssdasd(<?= $id ?>)" onkeypress="sssdasd(<?= $id ?>)" onkeyup="sssdasd(<?= $id ?>)" ondblclick="editarinterno(<?= $id ?>)" id="editint<?= $id ?>"><?= $t['texto'] ?></p>
                            <a href="javascript: editguard(<?= $id ?>)" title="Guardar Cambios" id="savecambio<?= $id ?>" class="savecambio<?= $id ?> icon2-save" style="display: none; float: left;">  </a>
                            <a title="Guardar Cambios" id="numbercambio<?= $id ?>" class="numbercambio<?= $id ?>" style="display: none; float: left; color: green; margin-left: 10px; ">140</a>
                            <input type="hidden" name="idusert" id="idusert<?= $id ?>" value="<?= $id ?>" />
                            <!--                            <footer class="twwet-text-footer">
                                                            <a class="url" href="">Detalle</a>
                                                        </footer>-->
                            <!--</a>-->
                            <p style="text-align: right;margin: 0px;height: 10px;">
                                <span id="pktweet" style="float: left;"></span>
                            <query id="<?= $id ?>">
                                <?php if ($hab === '1') { ?>
                                    <a href="javascript:habilitar(<?= $id . ',' . $hab ?>)"class="icon icon2-remove" title="Deshabilitar"></a>
                                    <!--echo "Deshabilitar";-->

                                <?php } else { ?>
                                    <!--echo "Habilitar";-->
                                    <a href="javascript:habilitar(<?= $id . ',' . $hab ?>)"class="icon icon-check" title="Habilitar"></a>

                                <?php } ?>
                            </query>

                            <elim class="elim2<?= $id ?>">
                                <a href="javascript:eliminar(<?= $id ?>)"class="icon icon2-trash" title="Eliminar"></a>
                            </elim>
                            <a onclick="editarinterno(<?= $id ?>)" class="icon icon-pencil"  title="Editar"></a>
                            <!--<a onclick="editar(<?= $id ?>)" class="icon icon-pencil" href="./#editweet" title="Editar"></a>-->
                            </p>

                        </div>
                    </div>
                </div>
            </article>
            <?php
        }
    }
}
?>
