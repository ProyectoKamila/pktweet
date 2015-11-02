<?
if (isset($this->data['retweet'])) {
    $this->data['retweet'] = array_reverse($this->data['retweet']);
    require_once('./application/libraries/twitteroauth.php');
    $connection = new TwitterOAuth('uZVld72gVQlyWlLmq2JvQlEXy', 'GsnVPoHtp4JgxBgLgznJ0sakBAwRRcPgyXuxiUsBKvc14JtiQX');
    $url = 'https://api.twitter.com/1.1/users/lookup.json';


    foreach ($this->data['retweet'] as $f) {
        $tweets = $connection->post($url, array('user_id' => $f['retweet_cuenta']));
//                        debug($tweets);
        if (is_array($tweets)) {
            $this->data['timg'] = $tweets[0]->profile_image_url;
            ?>
           
            <article class="togg-article elimfollow<?=
            $f['id_cuenta'];
            ?>">

                <div class="div">
                    <div class="twwet-text">
                        <div class="header">
                            <div  class="twwet-img">
                                <img src="<?= $this->data['timg'] ?>"/>
                            </div>
                            <div class="twwet-name">
                                <span class="name">
                                    <b><?= $tweets[0]->name; ?></b>
                                </span>
                                <span class="user"><a href="http://twitter.com/<?= $tweets[0]->screen_name ?>" target="_blank"> @<?= $tweets[0]->screen_name ?></a>
                                </span>
                            </div>
                        </div>
                        <p class="twwet-text-p"><a class="followuser<?= $f['id_cuenta']; ?>" href="Javascript:retweetdelete(<? echo "'". $f['retweet_cuenta'] . "'"; ?>);">Eliminar de la lista</a></p>
                    </div>

                </div>
            </article>
            <?
        }
        }
    } else {
        echo "<p class='pcolum' >no se ha encontrado</p>";
    }
    ?>