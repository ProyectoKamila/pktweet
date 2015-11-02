    <? foreach ($this->data['directmessage'] as $d) {      ?>
                <article class="togg-article directforelim<?= $d['id']; ?>" id="togg-article1">
                    <div class="div">
                        <div class="twwet-text">
                            <div class="header">
                             
                              
                         
                                    <p class="twwet-text-p"><?= $d['message']; ?></a></p>
                                    <footer class="twwet-text-footer">
                                        <a class="url directforelima<?= $d['id']; ?>" href="Javascript:directelim(<?= $d['id']; ?>)">Eliminar</a>
                                    </footer>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
    <? }      ?>