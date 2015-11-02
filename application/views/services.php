<?
$name = $this->user->information->name;
$s = explode(' ', $name);
$namel = $this->user->information->last_name;
$sl = explode(' ', $namel);
?>
<div class="pkbarra">
    <? if ($this->user->conect) { ?>
        <div class="profile" id="profile">
            <img src="http://pknetmarketing.com/images/<? echo $this->user->information->picture; ?>"/>
            <div class="gb_7" id="profile1"></div>
            <div class="gb_6" id="profile2"></div>
        </div>
        <div style="white-space: nowrap;">
            <div class="subl"  id="profile3">
                <div class="subl-margin">
                    <div class="left"><img class="prf" src="http://pknetmarketing.com/images/<? echo $this->user->information->picture; ?>"/></div>
                    <div class="left"><? echo $s[0] . "  " . $sl[0]; ?>
                        <br><a target="_blank" href="http://account.proyectokamila.com/p/account.php">Configurar Cuenta</a>
                        <br><a href="./controller/salir">Salir</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile icon icon-ionicons nav-servi" id="profile-nav">
            <div class="gb_7" id="profile-nav1"></div>
            <div class="gb_6" id="profile-nav2"></div>
        </div>
        <div style="white-space: nowrap;">
            <div class="subl"  id="profile-nav3">
                <div class="subl-marginq">
                    <ul class="ul-servi">
                        <li>
                            <a href="http://pkcut.net/l/">
                                <span><img src="http://pkcut.net/l/images/pkcut.png"/></span>
                                <span>PkCut</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://pkclick.com/panel">
                                <span><img src="http://pkclick.com/images/header/logo.png"/></span>
                                <span>PkClick</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://pkmailing.com/">
                                <span><img src="http://pktweet.com/img/pkt.png"/></span>
                                <span>PkTweet</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://pkmailing.com/">
                                <span><img src="http://pkmailing.com/images/mailing.png"/></span>
                                <span>PkMailing</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://networking.proyectokamila.com/">
                                <span><img src="http://pkmailing.com/images/pklogo.png"/></span>
                                <span>PkNetwork</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://cloud.proyectokamila.com/">
                                <span><img src="http://cloud.proyectokamila.com/core/img/logo-wide.svg"/></span>
                                <span>PkCloud</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    <? } ?>
    <? if (isset($this->data['cuentas'][0]['count(*)'])) { ?>
        <div id="boton" class="btn"><img src="./img/text-logo.png"/><div class="rmenu icon icon-fontawesome-webfont-7"></div></div>
        <img src="./img/pkt.png" style="height: 40px;display: block;margin: auto;margin-top: -40px;"/>
    <? } ?>
</div>