<?
if (isset($this->data['inofollow'])) {
    $this->data['inofollow'] = array_reverse($this->data['inofollow']);
    ?>
    <article class="togg-article">

        <div class="div">
            <div class="twwet-text">
                <div class="header">
                    <div  class="twwet-img">
                        <input type="checkbox" value="todos" name="checkall" id="checksearch" onclick="checksearch()"/>
                    </div>
                    <div class="twwet-name">
                        <span class="name">
                            <b>Seleccionar todos</b>
                        </span>
                        <p class="twwet-text-p"><a class="elimfollowa" href="Javascript:followsearch(<? echo "'" . $this->data['iden'] . "'"; ?>);">Seguir</a></p>


                    </div>
                </div>
            </div>

        </div>
    </article>
    <query class="loadchecksearch">
        <?
        foreach ($this->data['inofollow'] as $f) {
            ?>
            <article class="togg-article elimfollow<?= $f['id']; ?>">

                <div class="div">
                    <div class="twwet-text">
                        <div class="header">
                            <div  class="twwet-img">
                                <input type="checkbox" value="<? echo $f['id'] ?>" name="checksearch" class="checksearch" />

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
                        <p class="twwet-text-p"><a class="followuser<?= $f['id']; ?>" href="Javascript:followusersearch(<? echo "'" . $this->data['iden'] . "','" . $f['id'] . "'"; ?>);">Seguir a @<?= $f['screen_name'] ?></a></p>
                    </div>

                </div>
            </article>
            <?
        }
    } else {
        echo "<p class='pcolum' >no se ha encontrado</p>";
    }
    ?>