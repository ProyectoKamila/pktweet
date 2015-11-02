<?php $id = $this->data['iden']; ?>

?>
<?php // debug($this->data);?>
<?php if ($this->data['ctas'] && $this->data['intervalo']) { ?>
    <actualizar class="pktweetact" id="sortable">
        <?php $this->data['cantwet'] = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $this->data['iden'])); ?>
        <section class="columns ui-state-default">

            <header class="column-header" title="Intervalo de <?= $this->data['intervalo'][0]['intervalo'] ?> Min.">
                <div class="profile" id="profile-c" style="width: 15px;display: initial;padding: 0px 10px 0px 0px !important;">
                    <div class="gb_7" id="profile-c1" style="z-index: 1;top: 41px;left: 3%;"></div>
                    <div class="gb_6" id="profile-c2" style="z-index: 2;top: 42px;left: 3%;"></div>
                </div>
                Ciclica <span><a target="_blank" href="http://twitter.com/<?= $this->data['screenname'] ?>" style="color:white">@<?= $this->data['screenname'] ?></a>  (<?= $this->data['cantwet'][0]['count(*)'] ?>) </span><span style="color: #161616;text-shadow: 1px 2px 3px #D8D8D8;font-weight: bold;font-weight: bold;" title="Al ser vip la aplicacion twitteara todos los twitt sin ningun limite diario."><?php
                    if ($cupon > 0) {
                        echo ' VIP';
                    } else {
                        $follo;
                        echo ' ' . $this->data['ctas'][0]['tweets'] . '/96';
                    }
                    ?></span>
                <div style="white-space: nowrap;">
                    <div class="subl subl-c"  id="profile-c3">
                        <div class="subl-margin">
                            <div id='estl' name='estl'>
                                <?php $estatus = $this->data['estatuslista'][0]['estatus']; ?>
                                <?php if ($estatus == '0'): ?>
                                    <a href='javascript:activarlista(<?php echo $id; ?>,<?php echo $estatus; ?>)'>Deshabilitada</a>
                                <?php else: ?>
                                    <a href='javascript:activarlista(<?php echo $id; ?>,<?php echo $estatus; ?>)'>Habilitada</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="column-header-link icon icon-help" target="blank_" style="display: block !important" href="http://www.pkcut.net/l/2md78by" title="Programa los tweet que se ejecutaran automaticamente y el intervalo de tiempo en que saldran. "></a>
            </header>
            <div class="column-tweet">
                <div class="from">
                    <form method="post" style="padding-top: 5px;height: 35px;padding-left: 15px;">
                        Intervalo de:
                        <select id="intervalo">
                            <option value="1" <?php
                            if (isset($this->data['estatuslista'][0]['intervalo']) && $this->data['estatuslista'][0]['intervalo'] == 1) {
                                echo "selected";
                            }
                            ?>>1 min. </option>
                            <option value="5" <?php
                            if (isset($this->data['estatuslista'][0]['intervalo']) && $this->data['estatuslista'][0]['intervalo'] == 5) {
                                echo "selected";
                            }
                            ?>>5 min. </option>
                            <option value="10" <?php
                            if (isset($this->data['estatuslista'][0]['intervalo']) && $this->data['estatuslista'][0]['intervalo'] == 10) {
                                echo "selected";
                            }
                            ?>>10 min. </option>
                            <option value="15" <?php
                            if (isset($this->data['estatuslista'][0]['intervalo']) && $this->data['estatuslista'][0]['intervalo'] == 15) {
                                echo "selected";
                            }
                            ?>>15 min. </option>
                            <option value="20" <?php
                            if (isset($this->data['estatuslista'][0]['intervalo']) && $this->data['estatuslista'][0]['intervalo'] == 20) {
                                echo "selected";
                            }
                            ?>>20 min. </option>
                               <option value="45" <?php
                            if (isset($this->data['estatuslista'][0]['intervalo']) && $this->data['estatuslista'][0]['intervalo'] == 45) {
                                echo "selected";
                            }
                            ?>>45 min. </option>
                                  <option value="60" <?php
                            if (isset($this->data['estatuslista'][0]['intervalo']) && $this->data['estatuslista'][0]['intervalo'] == 60) {
                                echo "selected";
                            }
                            ?>>60 min. </option>
                                  <option value="720" <?php
                            if (isset($this->data['estatuslista'][0]['intervalo']) && $this->data['estatuslista'][0]['intervalo'] == 720) {
                                echo "selected";
                            }
                            ?>>12 Hrs. </option>
                                  <option value="1440" <?php
                            if (isset($this->data['estatuslista'][0]['intervalo']) && $this->data['estatuslista'][0]['intervalo'] == 1440) {
                                echo "selected";
                            }
                            ?>>24 Hrs. </option>
                        </select>
                        <!--<a class="  icon2-save" href="javascript:configinter(<?php echo $id; ?>)" style="margin-top: 15px;float: right !important;margin-left: 10px;"></a>-->
                        <button class="btn" onclick="javascript:configinter(<?php echo $id; ?>)">Cambiar</button>
                    </form>
                </div>
                <div class="margin margin-open" id="margin0">
                    <div id="tweet" class="tweet">
                        <form method="post" name="tweet" action="./controller/cyclic" id="tweet">
                            <textarea cols="30" rows="5" class="twit" name="twit" required onKeyup="valida_longitud();" onKeyUp="valida_longitud();" onKeyPress="valida_longitud();" ></textarea>
                            <div class="rs">
                                <input type="checkbox" value="twetear" id="tweet" title="Al chequear el tweet saldra inmediatamente">Tweetear</input>
                                <input type="text" name="caracteres" id="caracteres" size="3" value="140" readonly></input>
                                <input  type="button" name="guardarg" class="guardarg btn" id="guardarg" disabled="true" value="Agregar a la lista" onClick="algo();"></input>
                            </div>

                        </form>
                    </div>
                </div>
                <div  id="togg-article0" class="togg-article-open">
                    <query id='pktweet'>
                        <div class="newtweet" style="text-align: center;"></div>
                        <?php
                        require_once('./application/libraries/twitteroauth.php');
                        $connection = new TwitterOAuth('uZVld72gVQlyWlLmq2JvQlEXy', 'GsnVPoHtp4JgxBgLgznJ0sakBAwRRcPgyXuxiUsBKvc14JtiQX');
                        $url = 'https://api.twitter.com/1.1/users/lookup.json';
                        $tweets = $connection->post($url, array('user_id' => $this->data['idcuentatwitter']));
//                        debug($tweets);

                        $this->data['tname'] = $tweets[0]->name;
                        $this->data['timg'] = $tweets[0]->profile_image_url;
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
                                                    <img src="<?= $this->data['timg']; ?>"/>
                                                </div>
                                                <div class="twwet-name">
                                                    <span class="name">
                                                        <b><?= $this->data['tname']; ?></b>
                                                    </span>
                                                    <span class="user"> <a target="_blank" href="http://twitter.com/<?= $this->data['screenname'] ?>">@<?= $this->data['screenname'] ?></a></span>
                                                </div>
                                                <!--<p class="twwet-text-p">Haciendo pruebas de tweet automaticos en el nuevo kapptweet de <a class="url" href="https://twitter.com/Proyectokmila/">@Proyectokmila</a><a class="url" href="https://twitter.com/hashtag/UnaVidaPk?src=hash"> #UnaVidaPk</a></p>-->
                                                <p class="twwet-text-p twit<?php echo $id; ?> editint<?php echo $id; ?>" onkeydown="sssdasd(<?php echo $id; ?>)" onkeypress="sssdasd(<?php echo $id; ?>)" onkeyup="sssdasd(<?php echo $id ?>)" ondblclick="editarinterno(<?php echo $id; ?>)" id="editint<?= $id ?>"><?= $t['texto'] ?></p>
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
                                                <a onclick="editarinterno(<?php echo $id; ?>)" class="icon icon-pencil"  title="Editar"></a>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            }
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
        <!--************************************************************************no follower**********************************************-->

        <section class="columns ui-state-default">
            <header class="column-header"><span>No Seguidores (<contadork id='contadork'>0</contadork>) </span><span style="color: #161616;text-shadow: 1px 2px 3px #D8D8D8;font-weight: bold;" title="Al ser vip puedes dejar de seguir a los que desees cada vez que actualices"><?php
                    if ($cupon > 0) {
                        echo '<contadork id="seguidores" style="display:none">999999999</contadork> VIP';
                    } else {

                        echo ' <contadork id="seguidores">' . $this->data['ctasthis'][0]['seguidores'] . '</contadork>/150 x Día';
                    }
                    ?></span>
                <a class="column-header-link icon icon-help" target="blank_" style="display: block !important" href="http://www.pkcut.net/l/2md78by" title="Personas a las que sigues, que no te siguen de vuelta."></a>
            </header>

            <div class="column-tweet" id="noseguidores">

                <article class="togg-article">

                    <div class="div">
                        <div class="twwet-text">
                            <div class="header">


                            </div>
                            <p class="twwet-text-p"> <a href="Javascript:noseguidores(<?= $this->data['idcuentatwitter']; ?>);">Cargar no seguidores</a></p>
                        </div>

                    </div>
                </article>
            </div>   
        </section>
        <!--************************************************************************no follower**********************************************-->

        <section class="columns ui-state-default">
            <header class="column-header"><span title='Son las personas que te siguen que tu no sigues'>Mis Fans (<contadork id='contadorkuser'>0</contadork>) </span><span style="color: #161616;text-shadow: 1px 2px 3px #D8D8D8;font-weight: bold;" title="Al ser vip puedes seguir a los que desees cada vez que actualices"><?php
                    if ($cupon > 0) {
                        echo '<contadork id="fans" style="display:none">999999999</contadork> VIP';
                    } else {
                        $follo;
                        echo ' <contadork id="fans">' . $this->data['ctasthis'][0]['fans'] . '</contadork>/100 x Día';
                    }
                    ?></span>
                <a class="column-header-link icon icon-help" target="blank_" style="display: block !important" href="http://www.pkcut.net/l/2md78by" title="Personas que te siguen, que tu no sigues."></a>
            </header>
            <div class="column-tweet" id="fanssearch">
                <article class="togg-article">

                    <div class="div">
                        <div class="twwet-text">
                            <div class="header">


                            </div>
                            <p class="twwet-text-p"> <a href="Javascript:fans(<?= $this->data['idcuentatwitter']; ?>);">Cargar mis fans</a></p>
                        </div>

                    </div>
                </article>
            </div>   
        </section>
        <!--*********************************************copiarseguidores*******************************************************-->
        <!--        float: right;
            margin-top: 13px;
            border-radius: 10px;
            border: solid 1px;
            border-color: rgb(169, 169, 169);-->

        <section class="columns programada ui-state-default">
            <header class="column-header">
                <div>Copiar seguidores  <span style="color: #161616;text-shadow: 1px 2px 3px #D8D8D8;font-weight: bold;font-weight: bold;" title="Al ser vip puedes seguir cuantos desees cada vez que busques"><?php
                        if ($cupon > 0) {
                            echo '<contadork id="cpseguidores" style="display:none">999999999</contadork> VIP';
                        } else {
                            $follo;
                            echo ' <contadork id="cpseguidores">' . $this->data['ctasthis'][0]['cpseguidores'] . '</contadork>/100 x Día';
                        }
                        ?></span></div>
                <a class="column-header-link icon icon-help" target="blank_" style="display: block !important" href="http://www.pkcut.net/l/2md78by" title="Busca a un usuario de twitter y veras sus ultimos seguidores"></a>

            </header>
            <div class="column-tweet">
                <div class="form">
                    <!--<form action="">-->
                    <input type="text" name="d" id="valor1" style="margin: 9px;" placeholder="Ejem: Pktweet_"/>
                    <input type="button" class="btn" href="javascript:;" onclick="search($('#valor1').val());
                                    return false;" value="Buscar"/>
                    <!--</form>-->
                </div>
                <div id="resultado"></div>

            </div>


        </section>

        <!------------------------------------------------------------------------------------------------->
        <!--*********************************************************************fin**************************************************-->
        <!--******************************************************************automensaje***********************************************-->
        <section class="columns programada ui-state-default">
            <header class="column-header">Msj Directos a nuevos seguidores</span><a class="column-header-link icon icon-ionicons-2" id="togg1" onclick="abrir2()"></a><span style="color: #161616;text-shadow: 1px 2px 3px #D8D8D8;font-weight: bold;" title="Al ser vip la firma de pktweet no aparecera en el mensaje directo"><?php
                    if ($cupon > 0) {
                        echo ' VIP';
                    } else {
                        $follo;
                        echo ' Basico';
                    }
                    ?></span>

                <a class="column-header-link icon icon-help" target="blank_" style="display: block !important" href="http://www.pkcut.net/l/2md78by" title='Cada vez que un usuario te de "Seguir" le llegará el mensaje que coloques aqui como  bienvenida.'></a>

            </header>
            <div class="column-tweet">
                <div class="margin" id="margin"></div>
                <div id="tweet2" class="tweet2">

                    <form method="post" name="tweet2" action="./controller/cyclic" id="tweet2">
                        <textarea cols="30" rows="5" class="twit2" name="twit2" required onKeyup="valida_longitud2();"  onKeyPress="valida_longitud2();" placeholder="Ejem: <*pktweetnameandlastname*> ó <*pktweetuser*>  Muchas gracias por seguirme. "><*pktweetnameandlastname*> Muchas gracias por seguirme. </textarea>
                        <div class="rs">
                            <input type="text" name="caracteres2" id="caracteres2" size="3" value="123" readonly></input>
                            <input  type="button" name="guardarg" class="guardarg2 btn" id="guardarg2" disabled="true" value="Agregar a la lista" onClick="algo2();"></input>
                        </div>

                    </form>
                </div>
                <br>
                <br>
                <div class="newtweet2" style="text-align: center;"></div>
                <br>

                <query id="pktweet2">
                    <?php $this->load->view('kapp-tweet/listdirect'); ?>

                </query>



            </div>


        </section>
 <!--*********************************************retweet*******************************************************-->
        <!--        float: right;
            margin-top: 13px;
            border-radius: 10px;
            border: solid 1px;
            border-color: rgb(169, 169, 169);-->

        <section class="columns programada ui-state-default">
            <header class="column-header">
                <div>Cuentas para retweetear  <span style="color: #161616;text-shadow: 1px 2px 3px #D8D8D8;font-weight: bold;font-weight: bold;" title="Al ser vip puedes retweeteara de manera ilimitada"><?php
                        if ($cupon > 0) {
                            echo '<contadork id="retweet" style="display:none">999999999</contadork> VIP';
                        } else {
                            $follo;
                            echo ' <contadork id="retweet">' . $this->data['ctasthis'][0]['retweet'] . '</contadork>/50 x Día';
                        }
                        ?></span></div>
                <a class="column-header-link icon icon-help" target="blank_" style="display: block !important" href="http://www.pkcut.net/l/2md78by" title="Ingresa un usuario de twitter para agregar a la lista de las personas a retweetear cada 5 minutos"></a>

            </header>
            <div class="column-tweet">
                <div class="form">
                    <!--<form action="">-->
                    <input type="text" name="d" id="valor2" style="margin: 9px;" placeholder="Ejem: Pktweet_"/>
                    <input type="button" class="btn" href="javascript:;" onclick="retweet($('#valor2').val());
                                    return false;" value="Ingresar usuario"/>
                    <!--</form>-->
                </div>
                <div id="resultretweet"><? $this->load->view('kapp-tweet/retweet')?></div>

            </div>


        </section>

        <!------------------------------------------------------------------------------------------------->
        <!--*********************************************************************fin**************************************************-->
        <!--************************************************************************AYUDA**********************************************-->
        <section class="columns ui-state-default">
            <header class="column-header" title="Intervalo de <?= $this->data['intervalo'][0]['intervalo'] ?> Min.">
                <span>Ayuda</span>
            </header>
            <div class="column-tweet">
                <article class="togg-article">
                    <!--                    <div class="div">
                                            <div class="twwet-text" style="padding-left: 5px;">
                                                <div class="header">-->
                    <p class="twwet-text-p" style="text-align: justify !important;white-space: pre-wrap !important;display: none;">
                    <ul>
                        <li style="white-space: pre-wrap !important;">Para agregar una cuenta haz click en el &iacute;cono de barras, para desplegar/ocultar el men&uacute; general.</li>
                        <li style="white-space: pre-wrap !important;">En agregar cuenta agrega hasta 5 cuentas de Twitter.</li>
                        <li style="white-space: pre-wrap !important;">Ver&aacute;s el nombre de la cuenta que estas gestionando al lado de la palabra c&iacute;clica.</li>
                        <li style="white-space: pre-wrap !important;">Para agregar un tuit a la lista f&iacute;jate en la columna que se titula <strong>"C&iacute;clica"</strong> </li>
                        <li style="white-space: pre-wrap !important;">En el recuadro grande escribe lo que deseas tuitear y cuando est&eacute; listo has click en el bot&oacute;n <strong>"Agregar a la lista".</strong></li>
                        <li style="white-space: pre-wrap !important;">Puedes editar el tiempo de publicaci&oacute;n de tus tuits donde dice <strong>Intervalo de:</strong> puedes configurar de <strong>5,10,15 y 20min.</strong> Una vez que hayas seleccionado el tiempo presiona cambiar para que los cambios se guarden.</li>
                        <li style="white-space: pre-wrap !important;">Puedes añadir mensajes directos a nuevos seguidores, Ejem: <*pktweetnameandlastname*> ó <*pktweetuser*>  Muchas gracias por seguirme. </li>
                        <!--<li style="white-space: pre-wrap !important;"></li>-->
                    </ul>
                    </p>
                    <!--                            </div>
                                            </div>
                                        </div>-->

                </article>
            </div>
        </section>

                                                                                                            <!--    <section class="columns programada ui-state-default">
                                                                                                                    <header class="column-header">Programada <span>@<?= $this->data['screenname'] ?></span><a class="column-header-link icon icon-ionicons-2" id="togg1" onclick="abrir2()"></a></header>
                                                                                                                    <div class="column-tweet">
                                                                                                                        <div class="margin" id="margin1"></div>
        <? // for ($j = 0; $j <= 10; $j++) {          ?>
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
        <? // }         ?>



                                                                                                                    </div>


                                                                                                                </section>-->
        <?php foreach ($widget as $w) { ?>
            <section class="columns ui-state-default">
                <header class="column-header">Widget <span><?= $w['name'] ?></span><a class="column-header-link icon icon-ionicons-2" id="togg1"></a></header>
                    <?= $w['widget'] ?>
            </section>
        <?php } ?>
    </actualizar>
    <!------------------------------------------------------------------------------------------------->
<?php } ?>
