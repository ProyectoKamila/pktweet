<?php

class Automatic extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
    }


    public function index() {
        header('Content-Type: text/html; charset=UTF-8');
        ini_set('display_errors', 1);
        $this->conection();
        //aqui lo de llamar las cuenta sy enviar un solo tweet por cuenta
        $idcuenta = $this->data['idcuenta'] = $select = $this->modelo_universal->select('cuentas', 'id_cuenta');

        foreach ($idcuenta as $id) {
            $idt = $id['id_cuenta'];
//            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', 'texto', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', '*', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
            $datos = $this->data['datos'] = $select = $this->modelo_universal->select('cuentas', 'oauth_token_secret,oauth_token', array('id_cuenta' => $idt));
            $token = $datos[0]['oauth_token'];
            $tokensecret = $datos[0]['oauth_token_secret'];
            if (!empty($tws[0]['texto'])) {
//        debug($tws[0]['posicion'], false);
//        debug("-----------------------------");
//            echo'-----------------------------------------------------<br>';
        echo ('Texto del tweet: '.$tws[0]['texto'].'<br>');
        echo 'Token: '.$token.'<br>';
        echo 'Token secret: '.$tokensecret.'<br>';
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

                $this->modelo_universal->update('tweet', array('estatus' => 1), array('id_cuenta' => $idt,'posicion' =>$tws[0]['posicion']));
//                debug($twitteroauth, false);
//                debug("---------------------------", false);
            }
        
            
            $pr=$this->data['pr'] = $select = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta'=>$idt, 'habilitar'=>1));
        $sg=$this->data['sg'] = $select = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta'=>$idt, 'habilitar'=>1, 'estatus'=>1));
        if($pr[0]['count(*)']===$sg[0]['count(*)']){
            $this->modelo_universal->update('tweet', array('estatus' => 0), array('id_cuenta' => $idt));
        }
        }
    }

    public function index1() {
        $resultado = $this->modelo_universal->select('lista_ciclica,tweet,tiempo', '*', array('lista_ciclica.estatus' => 0, 'tweet.id_tiempo' => 'tiempo.id_tiempo', 'lista_ciclica.id_tweet' => 'tweer.id_twett', 'tweet.id_lista' => 'lista_ciclica.id_ciclica'));
        debug($resultado);
    }

    public function conection() {
        $this->config();
        require_once('./application/libraries/twitteroauth.php');
        require_once('./application/libraries/TwitterAPIExchange.php');
    }

    private function config() {
        define('CONSUMER_KEY', 'XDfh6ZDVP9gbHwYIYG7uuZczG');
        define('CONSUMER_SECRET', '7BgUcOrNYOTsUUArQOYdu5QpfJc24DCb0so5Tp96W7nKBUtFDP');
        define('OAUTH_CALLBACK', 'http://127.0.0.1/pktweetsvn/process');
    }

    public function consulta() {
        //funcion para consultar todos los tweets que no se han enviado
        $resultado = $this->data['noenviados'] = $this->modelo_universal->select('lista_ciclica', '*', array('estatus' => 0));
    }

}
?>