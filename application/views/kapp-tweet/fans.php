<?php
$follo = 0;
if (isset($this->data['inofollow'])) {

    $follo = count($this->data['inofollow']);
}
?>
<script>
    $('#contadorkuser').html(<?= $follo ?>);
</script>
<?php
if (isset($this->data['inofollow'])) {
    $this->data['inofollow'] = array_reverse($this->data['inofollow']);
    ?>
    <article class="togg-article">

        <div class="div">
            <div class="twwet-text">
                <div class="header">
                    <div  class="twwet-img">
                        <input type="checkbox" value="todos" name="checkall" id="checkfans" onclick="checkfans()"/>
                    </div>
                    <div class="twwet-name">
                        <span class="name">
                            <b>Seleccionar todos</b>
                        </span>
                        <p class="twwet-text-p"><a class="elimfollowa" href="Javascript:seguirfans(<? echo "'" . $this->data['idcuenta'] . "'"; ?>);">Seguir</a></p>


                    </div>
                </div>
            </div>

        </div>
    </article>
    <query class="loadcheckfans">
        <?
        foreach ($this->data['inofollow'] as $f) {
            ?>
            <article class="togg-article elimfollow<?= $f['id']; ?>">

                <div class="div">
                    <div class="twwet-text">
                        <div class="header">
                            <div  class="twwet-img">
                                <input type="checkbox" value="<? echo $f['id'] ?>" name="checkfans" class="checkfans" />
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
                        <p class="twwet-text-p"><a class="followuser<?= $f['id']; ?>" href="Javascript:followuser(<? echo "'" . $this->data['idcuenta'] . "','" . $f['id'] . "'"; ?>);">Seguir a @<?= $f['screen_name'] ?></a></p>
                    </div>

                </div>
            </article>
            <?php
        }
    } elseif ($this->data['true'] == false) {
        echo "No se han encontrado mas";
    } else {
        echo "el limite de solicitudes a twitter,<br>ha excedido en su cuenta<br>consulte en un rato";
    }
    ?>
</query>
<article class="togg-article">

    <div class="div">
        <div class="twwet-text">
            <div class="header">


            </div>
            <p class="twwet-text-p"> <a href="Javascript:fans(<?= $this->data['idcuenta'] ?>);">Cargar Seguidores que no sigo</a></p>
        </div>

    </div>
</article>