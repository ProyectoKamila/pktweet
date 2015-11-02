<actualizar class="pktweetact" id="sortable">
    <? // debug($this->data);?>
    <? $this->data['cantwet'] = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $this->data['iden']));?>
    <? // debug($this->data['cantwet'][0]['count(*)']);?>
    <section class="columns ui-state-default">
        <header class="column-header" >Ciclica <span>@<?= $this->data['screenname'] ?>  </span><a class="column-header-link icon icon-ionicons-2" id="togg0" onclick="abrir()"></a></header>
<!--        <div class="column-tweet">
            
            <div><form>
                Intervalo de: <select name="intervalo" id="intervalo" required >
            <option value="5">5 min. </option>
            <option value="10">10 min. </option>
            <option value="15">15 min. </option>
            <option value="20">20 min. </option>
        </select>
             <a class="  icon2-save" href="intervalo()"></a>
                </form>
            </div>-->
            
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
                    <?
                    require_once('./application/libraries/twitteroauth.php');
                    $connection = new TwitterOAuth('uZVld72gVQlyWlLmq2JvQlEXy', 'GsnVPoHtp4JgxBgLgznJ0sakBAwRRcPgyXuxiUsBKvc14JtiQX');
                    $urlapi = "statuses/user_timeline.json?screen_name=" . $this->data['screenname'] . "&count=5";
                    $tweets = $connection->get("https://api.twitter.com/1.1/" . $urlapi);
                    $this->data['tname'] = $tweets[0]->user->name;
                    $this->data['timg'] = $tweets[0]->user->profile_image_url;
                    ?>
                    <? $tex = $this->data['tweet']; ?>
                    <? if (isset($tex)) { ?>
                        <? foreach ($tex as $t) { ?>
                            <? $id = $t['id_twett']; ?>
                            <? $hab = $t['habilitar']; ?>
                            <? ?>
                            <? ?>
                            <article class="togg-article elim<?= $id; ?>">
                                <div class="div">
                                    <div class="twwet-text">
                                        <div class="header">
                    <!--                        <time>
                                                <a href="">5m</a>
                                            </time>-->
                                            <!--<a class="account-linck" href="">-->
                                            <div  class="twwet-img">
                                                <img src="<?=$this->data['timg']; ?>"/>
                                            </div>
                                            <div class="twwet-name">
                                                <span class="name">
                                                    <b><?= $this->data['tname']; ?></b>
                                                </span>
                                                <span class="user"> @<?= $this->data['screenname'] ?></span>
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
                                                <? if ($hab === '1') { ?>
                                                    <a href="javascript:habilitar(<?= $id . ',' . $hab ?>)"class="icon icon2-remove" title="Deshabilitar"></a>
                                                    <!--echo "Deshabilitar";-->

                                                <? } else { ?>
                                                    <!--echo "Habilitar";-->
                                                    <a href="javascript:habilitar(<?= $id . ',' . $hab ?>)"class="icon icon-check" title="Habilitar"></a>

                                                <? } ?>
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
                        <? } ?>
                        <?
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
    <? // for ($j = 0; $j <= 10; $j++) {   ?>
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
    <? // }   ?>



        </div>


    </section>-->
    <? foreach ($widget as $w) {
        ?>
        <section class="columns ui-state-default">
            <header class="column-header">Widget <span><?= $w['name'] ?></span><a class="column-header-link icon icon-ionicons-2" id="togg1"></a></header>
                <?= $w['widget'] ?>
        </section>
        <?
    }
    ?>
</actualizar>
<!------------------------------------------------------------------------------------------------->
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
  $(function() {
      $("#sortable").sortable({
          revert: true
      });
  });
</script>-->