<?php

class Automatic extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
    }

    public function indexr($i = null) {  //viejo
        if (isset($_GET['pass']) && $_GET['pass'] != 'hackemate') {
            exit();
        }
        header('Content-Type: text/html; charset=UTF-8');
        ini_set('display_errors', 1);
        $this->conection();
        //aqui lo de llamar las cuenta sy enviar un solo tweet por cuenta
        //$idcuenta = $this->data['idcuenta'] = $select = $this->modelo_universal->select('cuentas', 'id_cuenta,tweets,fecha_f');
        $idcuenta = $this->modelo_universal->query('SELECT  id_cuenta,tweets,fecha_f,oauth_token_secret,oauth_token FROM cuentas GROUP BY id_cuenta');

        foreach ($idcuenta as $id) {
            $fecha = strtotime($id['fecha_f']);
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date);
                $bol = false;
                if ($today < $fecha) {
                    $bol = true;
                } elseif ($id['tweets'] > 0) {
                    $bol = true;
                }
              if($bol){
//            SELECT * FROM tweet, lista_ciclica WHERE tweet.habilitar= 1 AND tweet.status= 0 AND tweet.id_cuenta = $idt AND lista_ciclica.intervalo = $i
            $idt = $id['id_cuenta'];
//            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', 'texto', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
//            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', '*', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
            $tws = $this->data['tws'] = $this->modelo_universal->query('SELECT * FROM tweet, lista_ciclica WHERE tweet.habilitar= 1 AND tweet.estatus= 0 AND tweet.id_cuenta = ' . $idt . ' AND lista_ciclica.intervalo = ' . $i . ' AND lista_ciclica.id_cuenta = tweet.id_cuenta');
            $datos = $this->data['datos'] = $select = $this->modelo_universal->select('cuentas', 'oauth_token_secret,oauth_token', array('id_cuenta' => $idt));
            $token = $datos[0]['oauth_token'];
            $tokensecret = $datos[0]['oauth_token_secret'];
            if (!empty($tws[0]['texto'])) {
                $tweets = $id['tweets'] - 1;
                $select = $this->modelo_universal->update('cuentas', array('tweets' => $tweets), array('id_cuenta' => $id['id_cuenta']));
//        debug($tws[0]['posicion'], false);
//        debug("-----------------------------");
//            echo'-----------------------------------------------------<br>';
                echo ('Texto del tweet: ' . $tws[0]['texto'] . '<br>');
                echo 'Token: ' . $token . '<br>';
                echo 'Token secret: ' . $tokensecret . '<br>';
//        debug("---------------------------");
                $settings = array(
                    'oauth_access_token' => "$token",
                    'oauth_access_token_secret' => "$tokensecret",
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
                $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $token, $tokensecret);

                $url = 'https://api.twitter.com/1.1/statuses/update.json';
                $results = $twitteroauth->post($url, array(
                    'status' => $tws[0]['texto'],
                    'display_coordinates' => 'false'
                ));
//                debug($idt);

                $this->modelo_universal->update('tweet', array('estatus' => 1), array('id_cuenta' => $idt, 'posicion' => $tws[0]['posicion']));
//                debug($twitteroauth, false);
//                debug("---------------------------", false);
            }


//            $pr=$this->data['pr'] = $select = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta'=>$idt, 'habilitar'=>1));
            $pr = $this->data['pr'] = $select = $this->modelo_universal->select('tweet', 'count(*)', array('tweet.id_cuenta' => $idt, 'habilitar' => 1));
            $sg = $this->data['sg'] = $select = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $idt, 'habilitar' => 1, 'estatus' => 1));
            if ($pr[0]['count(*)'] === $sg[0]['count(*)']) {
                $this->modelo_universal->update('tweet', array('estatus' => 0), array('id_cuenta' => $idt));
            }
        }
        }
        $this->db->close();
    }

    public function index1() {
        $resultado = $this->modelo_universal->select('lista_ciclica,tweet,tiempo', '*', array('lista_ciclica.estatus' => 0, 'tweet.id_tiempo' => 'tiempo.id_tiempo', 'lista_ciclica.id_tweet' => 'tweer.id_twett', 'tweet.id_lista' => 'lista_ciclica.id_ciclica'));
        //debug($resultado);
    }

    public function conection() {
        $this->config();
        require_once('./application/libraries/twitteroauth.php');
        require_once('./application/libraries/TwitterAPIExchange.php');
    }

    private function config() {
          define('CONSUMER_KEY', 'RMJUIaiAJG6IaJVk25FS5lBVm');
        define('CONSUMER_SECRET', 'rPyu16cjxe3bbAUWIDr7szbFnTTuTPLTER3Nr2PKXffK0JnBfG');
        define('OAUTH_CALLBACK', 'http://pktweet.com/process');
    }

    public function consulta() {
        //funcion para consultar todos los tweets que no se han enviado
        $resultado = $this->data['noenviados'] = $this->modelo_universal->select('lista_ciclica', '*', array('estatus' => 0));
    }


    public function index($i = null) {
        if (isset($_GET['pass']) && $_GET['pass'] != 'hackemate') {
            exit();
        }

        header('Content-Type: text/html; charset=UTF-8');
        ini_set('display_errors', 1);
        $this->conection();
        //$idcuenta = $this->data['idcuenta'] = $select = $this->modelo_universal->select('cuentas', 'id_cuenta,tweets,fecha_f');
        //$idcuenta = $this->data['idcuenta'] = $select = $this->modelo_universal->select('cuentas', '*');
        $idcuenta = $this->modelo_universal->query('SELECT  id_cuenta,tweets,fecha_f,oauth_token_secret,oauth_token FROM cuentas GROUP BY id_cuenta');
        //2541673982
        //2557522609    pk
        //$r = $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
        //debug($idcuenta);
        //debug($r);


        foreach ($idcuenta as $id) {
            $fecha = strtotime($id['fecha_f']);
            //debug($fecha,false);
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date);
                //debug($today,false);
                $bol = false;
                if ($today < $fecha) {
                    $bol = true;
                    //debug('true',false);
                } elseif ($id['tweets'] > 0) {
                    $bol = true;
                    //debug(false,false);
                }
              if($bol){
//            SELECT * FROM tweet, lista_ciclica WHERE tweet.habilitar= 1 AND tweet.status= 0 AND tweet.id_cuenta = $idt AND lista_ciclica.intervalo = $i
            $idt = $id['id_cuenta'];
//            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', 'texto', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
//            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', '*', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
            $tws = $this->data['tws'] = $this->modelo_universal->query('SELECT * FROM tweet, lista_ciclica WHERE tweet.habilitar= 1 AND tweet.estatus= 0 AND tweet.id_cuenta = ' . $idt . ' AND lista_ciclica.intervalo = ' . $i . ' AND lista_ciclica.id_cuenta = tweet.id_cuenta');
            $datos = $this->data['datos'] = $select = $this->modelo_universal->select('cuentas', 'oauth_token_secret,oauth_token', array('id_cuenta' => $idt));
            $token = $datos[0]['oauth_token'];
            $tokensecret = $datos[0]['oauth_token_secret'];
            //debug($tws);
               // debug('aqui');
            if (!empty($tws[0]['texto'])) {
                $tweets = $id['tweets'] - 1;
                $select = $this->modelo_universal->update('cuentas', array('tweets' => $tweets), array('id_cuenta' => $id['id_cuenta']));
//        debug($tws[0]['posicion'], false);
//        debug("-----------------------------");
//            echo'-----------------------------------------------------<br>';
                echo ('Texto del tweet: ' . $tws[0]['texto'] . '<br>');
                echo 'Token: ' . $token . '<br>';
                echo 'Token secret: ' . $tokensecret . '<br>';
//        debug("---------------------------");
                $settings = array(
                    'oauth_access_token' => "$token",
                    'oauth_access_token_secret' => "$tokensecret",
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
                $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $token, $tokensecret);

                $url = 'https://api.twitter.com/1.1/statuses/update.json';
                $results = $twitteroauth->post($url, array(
                    'status' => $tws[0]['texto'],
                    'display_coordinates' => 'false'
                ));
//                debug($idt);
                //debug($results);

                $this->modelo_universal->update('tweet', array('estatus' => 1), array('id_cuenta' => $idt, 'posicion' => $tws[0]['posicion']));
//                debug($twitteroauth, false);
//                debug("---------------------------", false);
            }


//            $pr=$this->data['pr'] = $select = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta'=>$idt, 'habilitar'=>1));
            $pr = $this->data['pr'] = $select = $this->modelo_universal->select('tweet', 'count(*)', array('tweet.id_cuenta' => $idt, 'habilitar' => 1));
            $sg = $this->data['sg'] = $select = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $idt, 'habilitar' => 1, 'estatus' => 1));
            if ($pr[0]['count(*)'] === $sg[0]['count(*)']) {
                $this->modelo_universal->update('tweet', array('estatus' => 0), array('id_cuenta' => $idt));
            }
        }
        }
        $this->db->close();

    }

}

?>