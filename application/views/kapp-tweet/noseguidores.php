<?php
$follo = 0;
if (isset($this->data['nofollow'])) {


    $follo = count($this->data['nofollow']);
}
?>
<script>
    $('#contadork').html(<?= $follo ?>);
</script>
<?php
if (isset($this->data['nofollow'])) {
    $this->data['nofollow'] = array_reverse($this->data['nofollow']);
    ?>
    <article class="togg-article">

        <div class="div">
            <div class="twwet-text">
                <div class="header">
                    <div  class="twwet-img">
                        <input type="checkbox" value="todos" name="checkall" id="checknofollow" onclick="checknofollow()"/>
                    </div>
                    <div class="twwet-name">
                        <span class="name">
                            <b>Seleccionar todos</b>
                        </span>
                        <p class="twwet-text-p"><a class="elimfollowa" href="Javascript:eliminarfollowall(<? echo "'" . $this->data['idcuenta'] . "'"; ?>);">Dejar de seguir</a></p>


                    </div>
                </div>
            </div>

        </div>
    </article>
<query class="loadcheck">
    <?
    foreach ($this->data['nofollow'] as $f) {
        ?>
        <article class="togg-article elimfollow<?= $f['id']; ?>">

            <div class="div">
                <div class="twwet-text">
                    <div class="header">
                        <div  class="twwet-img">
                            <input type="checkbox" value="<? echo $f['id'] ?>" name="checknofollow" class="checknofollow" />
                            <img src="<?= $f['image'] ?>"/>
                        </div>
                        <div class="twwet-name">
                            <span class="name">
                                <b><?= $f['name']; ?></b>
                            </span>
                            <span class="user"><a href="http://twitter.com/<?= $f['screen_name'] ?>" target="_blank"> @<?= $f['screen_name'] ?></a>
                            </span>
                        </div>
                    </div>
                    <p class="twwet-text-p"><a class="elimfollowa<?= $f['id']; ?>" href="Javascript:eliminarfollow(<? echo "'" . $this->data['idcuenta'] . "','" . $f['id'] . "'"; ?>);">Dejar de seguir</a></p>
                </div>

            </div>
        </article>
        <?
    }
}
elseif($this->data['true']==false){
    echo "No se han encontrado mas";
}
else {
    echo "el limite de solicitudes a twitter,<br>ha excedido en su cuenta<br>consulte en un rato";
}
?>
    </query>
<article class="togg-article">

    <div class="div">
        <div class="twwet-text">
            <div class="header">


            </div>
            <p class="twwet-text-p"> <a href="Javascript:noseguidores(<?= $this->data['idcuenta'] ?>);">Cargar no seguidores</a></p>
        </div>

    </div>
</article>
    