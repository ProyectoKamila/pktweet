<?php

class Retweet extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
    }

    public function index() {
        if (!isset($_GET['pass']) || $_GET['pass'] != 'hackemate') {
            exit();
        }
        header('Content-Type: text/html; charset=UTF-8');
        ini_set('display_errors', 1);
        $this->conection();
        //aqui lo de llamar las cuenta sy enviar un solo tweet por cuenta
        $idcuenta = $this->data['idcuenta'] = $select = $this->modelo_universal->select('cuentas', 'id_cuenta,retweet,fecha_f,ordenretweet,oauth_token_secret,oauth_token');
//debug($idcuenta);
        foreach ($idcuenta as $id) {
            $fecha = strtotime($id['fecha_f']);
            $todays_date = date("Y-m-d");
            $today = strtotime($todays_date);
            $bol = false;
            if ($today < $fecha) {
                $bol = true;
            } elseif ($id['retweet'] > 0) {
                $bol = true;
            }
            if ($bol) {
                $idt = $id['id_cuenta'];
                $text = $this->modelo_universal->select('retweet', '*', array('id_cuenta ' => $idt));
                if ($text) {
//            debug($id);

//            SELECT * FROM tweet, lista_ciclica WHERE tweet.habilitar= 1 AND tweet.status= 0 AND tweet.id_cuenta = $idt AND lista_ciclica.intervalo = $i
//            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', 'texto', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
//            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', '*', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
//            $tws = $this->data['tws']= $this->modelo_universal->query('SELECT * FROM tweet join lista_ciclica WHERE lista_ciclica.id_cuenta = tweet.id_cuenta AND tweet.habilitar= 1 AND tweet.estatus= 0 AND tweet.id_cuenta = '.$idt.' AND lista_ciclica.intervalo = '.$i.'');
//            debug($this->db->last_query());
                    $token = $id['oauth_token'];
                    $tokensecret = $id['oauth_token_secret'];

//        debug($tws[0]['posicion'], false);
//        debug("-----------------------------");
//            echo'-----------------------------------------------------<br>';
//        echo ('Texto del tweet: '.$tws[0]['texto'].'<br>');
//        echo 'Token: '.$token.'<br>';
//        echo 'Token secret: '.$tokensecret.'<br>';
//        debug("---------------------------");
                    $settings = array(
                        'oauth_access_token' => "$token",
                        'oauth_access_token_secret' => "$tokensecret",
                        'consumer_key' => CONSUMER_KEY,
                        'consumer_secret' => CONSUMER_SECRET
                    );
                    $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $token, $tokensecret);
                    if (isset($text[$id['ordenretweet']]['retweet_cuenta'])) {
                        $lacuenta = $text[$id['ordenretweet']]['retweet_cuenta'];
                        $orden = $id['ordenretweet'] + 1;
                    } else {
                        $lacuenta = $text[0]['retweet_cuenta'];
                        $orden = 0;
                    }
                    $retweet = $id['retweet'] - 1;
                    $this->modelo_universal->update('cuentas', array('ordenretweet' => $orden, 'retweet' => $retweet), array('id_cuenta' => $idt));
                    $cuentaretweet = $lacuenta;
                    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?COUNT=1&user_id=' . $cuentaretweet;
                    $results = $twitteroauth->get($url);
//                    debug($results[0],false);
                    if (is_array($results) && isset($results[0]->id_str)) {
                        $check=$this->modelo_universal->select('retweet_send','*',array('id_cuenta'=>$idt,'id_tweet'=>$results[0]->id_str));
                        if (!$check){
                      $this->modelo_universal->insert('retweet_send',array('id_cuenta'=>$idt,'id_tweet'=>$results[0]->id_str));
                        $url = 'https://api.twitter.com/1.1/statuses/retweet/' . $results[0]->id_str . '.json';
                        $results = $twitteroauth->POST($url);
//                        debug($url,false);
//                        debug($results);
                    }
                    }

//                debug($message);
                }
//        }
            }
        }
        $this->db->close();
    }

    public function conection() {
        $this->config();
        require_once('./application/libraries/twitteroauth.php');
        require_once('./application/libraries/TwitterAPIExchange.php');
    }

    private function config() {
        define('CONSUMER_KEY', 'fjJcBuRxjHf4Q2gJ2TMcy1h1B');
        define('CONSUMER_SECRET', '12CLsq4eMe7SElKD3ItuRvgkD18CFMGfTfR2zTHgxVwuKS7zqa');
        define('OAUTH_CALLBACK', 'http://pktweet.com/process');
    }



}

?>