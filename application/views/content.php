<actualizar class="pktweetact" id="sortable">
    <?php $this->data['cantwet'] = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $this->data['iden']));?>
    <section class="columns ui-state-default">
        <header class="column-header" title="Intervalo de //<?= $this->data['intervalo'][0]['intervalo']?> Min.">Ciclica <span>@<?= $this->data['screenname'] ?>  (<?= $this->data['cantwet'][0]['count(*)']?>)</span><a class="column-header-link icon icon-ionicons-2" id="togg0" onclick="abrir()"></a></header>
            
        <div class="column-tweet">
            <div class="margin" id="margin0">
                <div id="tweet" class="tweet">
                    <form method="post" name="tweet" action="./controller/cyclic" id="tweet">
                        <textarea cols="30" rows="5" class="twit" name="twit" required onKeyup="valida_longitud();" onKeyUp="valida_longitud();" onKeyPress="valida_longitud();" ></textarea>
                        <div class="rs">
                            <input type="text" name="caracteres" id="caracteres" size="3" value="140" readonly></input>
                            <input  type="button" name="guardarg" class="guardarg btn" id="guardarg" disabled="true" value="Agregar a la lista" onClick="algo();"></input>
                        </div>

                    </form>
                </div>
            </div>
            <div  id="togg-article0">
                <query id='pktweet'>
                    <div class="newtweet" style="text-align: center;"></div>
                    <?php
                    require_once('./application/libraries/twitteroauth.php');
                    $connection = new TwitterOAuth('F4iItkUoo9No1lY3jb161Galf', 'zT5fn2RfGjG6Z7LDPhirHlicLpmmF0PcfDEEMAg07ytk5gCFVg');
                    $urlapi = "statuses/user_timeline.json?screen_name=" . $this->data['screenname'] . "&count=5";
                    $tweets = $connection->get("https://api.twitter.com/1.1/" . $urlapi);
                    $this->data['tname'] = $tweets[0]->user->name;
                    if(isset($tweets[0]->user->profile_image_url)){
                        
                    $this->data['timg'] = $tweets[0]->user->profile_image_url;
                    }else{
                       $this->data['timg']= "./img/pf.png"; 
                    }
                    ?>
                    <?php $tex = $this->data['tweet']; ?>
                    <?php if (isset($tex)) { ?>
                        <?php foreach ($tex as $t) { ?>
                            <?php $id = $t['id_twett']; ?>
                            <?php $hab = $t['habilitar']; ?>
                            <article class="togg-article elim<?= $id; ?>">
                                <div class="div">
                                    <div class="twwet-text">
                                        <div class="header">
                                            <div  class="twwet-img">
                                                <img src="<?=$this->data['timg']; ?>"/>
                                            </div>
                                            <div class="twwet-name">
                                                <span class="name">
                                                    <b><?= $this->data['tname']; ?></b>
                                                </span>
                                                <span class="user"> @<?= $this->data['screenname'] ?></span>
                                            </div>
                                            <p class="twwet-text-p twit<?= $id ?> editint<?= $id ?>" onkeydown="sssdasd(<?= $id ?>)" onkeypress="sssdasd(<?= $id ?>)" onkeyup="sssdasd(<?= $id ?>)" ondblclick="editarinterno(<?= $id ?>)" id="editint<?= $id ?>"><?= $t['texto'] ?></p>
                                            <a href="javascript: editguard(<?= $id ?>)" title="Guardar Cambios" id="savecambio<?= $id ?>" class="savecambio<?= $id ?> icon2-save" style="display: none; float: left;">  </a>
                                            <a title="Guardar Cambios" id="numbercambio<?= $id ?>" class="numbercambio<?= $id ?>" style="display: none; float: left; color: green; margin-left: 10px; ">140</a>
                                            <input type="hidden" name="idusert" id="idusert<?= $id ?>" value="<?= $id ?>" />
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
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php } 
                    } else {
                        if ($tex == null) {
                            echo ('No hay tweets en la lista');
                        }
                    }
                    ?>
                </query>
            </div>
        </div>
    </section>
    <!------------------------------------------------------------------------------------------------->
<!--    <section class="columns programada ui-state-default">
        <header class="column-header">Programada <span>@<?= $this->data['screenname'] ?></span><a class="column-header-link icon icon-ionicons-2" id="togg1" onclick="abrir2()"></a></header>
        <div class="column-tweet">
            <div class="margin" id="margin1"></div>
    <?php  ?>
            <article class="togg-article" id="togg-article1">
                <div class="div">
                    <div class="twwet-text">
                        <div class="header">
                            <time>
                                <a href="">5m</a>
                            </time>
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
                                <p class="twwet-text-p">Haciendo pruebas de tweet automaticos en el nuevo kapptweet de <a class="url" href="https://twitter.com/Proyectokmila/">@Proyectokmila</a><a class="url" href="https://twitter.com/hashtag/UnaVidaPk?src=hash"> #UnaVidaPk</a></p>
                                <footer class="twwet-text-footer">
                                    <a class="url" href="">Detalle</a>
                                </footer>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
    <?php  ?>



        </div>


    </section>-->
    <?php foreach ($widget as $w) {
        ?>
        <section class="columns ui-state-default">
            <header class="column-header">Widget <span><?= $w['name'] ?></span><a class="column-header-link icon icon-ionicons-2" id="togg1"></a></header>
                <?= $w['widget'] ?>
        </section>
        <?php
    }
    ?>
</actualizar>
<!------------------------------------------------------------------------------------------------->