<?php // debug($this->data);                         ?>

<?php // debug($this->user->information->pktweet);?>
<?php if (isset($this->data)) { ?>

    <div class="content">
        <script src="./scripts/source/jquery.fancybox.js"></script>
        <link rel="stylesheet" href="./scripts/source/jquery.fancybox.css">
        <script>
            $(document).ready(function() {
                console.log('fancy');
                $('.fancybox').fancybox();
            });
        </script> 
        <div id="activate" class="popu" style="display:none; max-width:500px; height:300px; max-width:100%; max-height:100%;">
            <p>Por Favor Autentifique de nuevo<br></p>    
            <a  href="http://www.pktweet.com/controller/process">Click Aqui</a>
        </div>
        <a href="#activate" class="fancybox" style="display:none;" id="bomba">modalventana</a>
        <div class="twwet-toggle open" id="target" >
            <div class="twwet-toggle-img">
                <i class="icon2-ticket" title="Cupones disponibles">(<?php echo $this->user->information->pktweet; ?>)</i> disponibles<br>
                Adquirir cupon: <a target="_blank"href="http://pknetmarketing.com/payment<?
                if (isset($_COOKIE['ip'])) {
                    echo "?ip=" . $_COOKIE['ip'];
                } elseif (isset($_GET['ip'])) {
                    echo "?ip=" . $_GET['ip'];
                }
                ?>" style="color: #3b88c3;">Aqui</a>
                Por tan solo $1.38 o 350Bs mensual.<br>
                Otros métodos de pago:
                <?
                if (isset($_COOKIE['ip'])) {
                    $COOKIE = $_COOKIE['ip'];
                } else {
                    $COOKIE = $_GET['ip'];
                }
                ?>
                <!--                
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="custom" value="<?= $COOKIE ?>">
                    <input type="hidden" name="hosted_button_id" value="KUYNXR4HFB8ZC">
                    <input style="height: 90px" type="image" src="./img/PayPal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                </form>
                -->
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="NUF39SRQPND8U">
                    <input type="hidden" name="custom" value="<?= $COOKIE ?>=">
                    <input style="height: 90px" type="image" src="./img/PayPal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                </form>

            </div>
            <!--            <h1>Configuración</h1>
                        <div class="twwet-toggle-img">
                            <a class="icon icon-user-add" href="./controller/process"></a>
                            <a class="icon icon-pencil" href=""></a>
                                                <div class="icon icon-user-add"></div>
                        </div>-->


            <!--            <div style="color:white">
                            Usted tiene 
            <?php echo $this->user->information->pktweet; ?> cupones disponibles
                        </div>
                        <div style="color:white">Active un cupon en esta cuenta <a href="controller/cupon/<?php echo $this->data['idcuentatwitter']; ?>">Aqui</a> </div>-->
            <h1>Cuentas de Twitter</h1>
            <br>
            <a class="icon icon-user-add" href="./controller/process"> Agregar cuenta</a>
            <?php $cuentas = $this->data['ctas']; ?>
            <!--<a href="">-->
            <?php
            if (isset($cuentas)) {
                $today = date('Y-m-d');
                foreach ($cuentas as $c) {
                    $id = $c['id_cuenta'];

                    $fecha = strtotime($c['fecha_f']) - strtotime($today);
                    $fecha = intval($fecha / 60 / 60 / 24);
//                debug($fecha);
                    ?>
                    <div class="twwet-toggle-img elim<?= $id ?>">
                        <?php
                        $nombre = $c['screen_name'];
                        require_once('./application/libraries/twitteroauth.php');
                        $connection = new TwitterOAuth('RMJUIaiAJG6IaJVk25FS5lBVm', 'rPyu16cjxe3bbAUWIDr7szbFnTTuTPLTER3Nr2PKXffK0JnBfG');
                        $url = 'https://api.twitter.com/1.1/users/lookup.json';
                        $tweets = $connection->post($url, array('user_id' => $id));
//                        if (isset($_GET['prueba'])) {
                            $connection = new TwitterOAuth('RMJUIaiAJG6IaJVk25FS5lBVm', 'rPyu16cjxe3bbAUWIDr7szbFnTTuTPLTER3Nr2PKXffK0JnBfG', $this->data['ctasthis'][0]['oauth_token'], $this->data['ctasthis'][0]['oauth_token_secret'], true);
                            $url = 'https://api.twitter.com/1.1/statuses/update.json';
                            $results = $connection->post($url, array(
                                'status' => '',
                                'display_coordinates' => 'false'
                            ));
        if(isset($results->errors[0]->code)){
                            if ($results->errors[0]->code == 32  || $results->errors[0]->code == 401 || $results->errors[0]->code == 64 || $results->errors[0]->code == 215 ) {
                        
                                ?>
                                <script> 
$(document).ready(function() {                                   
    $('#bomba').click();
});
                                  </script>
                                <?
                            }
                        }
//                        }
                        $this->data['timg'] = $tweets[0]->profile_image_url;
                        ?>
                        <!--<img src="./img/pf.png"/>-->
                        <img src="<?= $this->data['timg'] ?>" style="background-color: white;"/>

                        <?php
//                            echo " <a href='javascript: actualizar(" . $id . ")'>" . $nombre . "</a>";
                        echo " <a href='./profile/$id'>" . $nombre . "</a>";

                        echo "<a href='javascript: drop(" . $id . ")'>  <i class='icon2-trash'></i> </a><a href='javascript:cupon(" . $id . ")'>";

                        if ($fecha < 1) {
                            echo"<i class='icon2-star' title='Active un cupon en esta cuenta'></i></a><br></div>";
                        } else {
                            echo"<i class='icon2-star' style='color:yellow' title='Le quedan " . $fecha . " días'></i></a><br></div>";
                        }
                    }
                }
                ?>

                <!--</a>-->
                <h1 class="widget">Agregar Widget</h1>
                <div class="twwet-toggle-img">
                    <a class="icon icon-user-add" href="#" id="togg3"></a><br>
                    <div id="tweet3" class="tweet3" >
                        <form method="post" action="./controller/new_widget">
                            <input type="text" name="name" required="" placeholder="nombre del widget" autocomplete="off"/>
                            <textarea cols="15" rows="5" name="widget" required placeholder="Agrege el  widget de twitter aqui, o alguna nota"></textarea>
                            <div class="rs" style="width: 100%;margin-bottom: 20px;">
                                <input  type="submit" name="guardarg" class="btn"  value="Agregar a la lista" style="margin-bottom: 20px;"></input>
                            </div>

                        </form>
                    </div><br>
                    <?php foreach ($widget as $w) { ?>
                        <a class="icon icon2-trash" style="width: 100%;" href="./controller/delete_widget/<?= $w['id']; ?>"> <?= $w['name'] ?></a><br>
                    <?php } ?>

                </div>
            </div>


            <div class="columns-content topen">
                <?php $this->load->view("kapp-tweet/content"); ?>

            </div>
        </div>
        <?php
    } else {
        
    }
    ?>
    <!--141013510-->
