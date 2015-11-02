<?php

class Directmessageauto extends CI_Controller {

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
        $idcuenta = $this->data['idcuenta'] = $select = $this->modelo_universal->select('cuentas', 'id_cuenta');
//debug($idcuenta);
        foreach ($idcuenta as $id) {
            $idt = $id['id_cuenta'];
            $text = $this->modelo_universal->select('directmessage', 'message', array('id_cuenta ' => $idt), null, null, 'id', 'RANDOM');
            if ($text) {
                $text = $text[0]['message'];
//            SELECT * FROM tweet, lista_ciclica WHERE tweet.habilitar= 1 AND tweet.status= 0 AND tweet.id_cuenta = $idt AND lista_ciclica.intervalo = $i
//            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', 'texto', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
//            $tws = $this->data['tws'] = $select = $this->modelo_universal->select('tweet', '*', array('habilitar' => 1, 'estatus' => 0, 'id_cuenta' => $idt), '1');
//            $tws = $this->data['tws']= $this->modelo_universal->query('SELECT * FROM tweet join lista_ciclica WHERE lista_ciclica.id_cuenta = tweet.id_cuenta AND tweet.habilitar= 1 AND tweet.estatus= 0 AND tweet.id_cuenta = '.$idt.' AND lista_ciclica.intervalo = '.$i.'');
//            debug($this->db->last_query());
                $datos = $this->data['datos'] = $select = $this->modelo_universal->select('cuentas', 'oauth_token_secret,oauth_token', array('id_cuenta' => $idt));
                $token = $datos[0]['oauth_token'];
                $tokensecret = $datos[0]['oauth_token_secret'];

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

                $url = 'https://api.twitter.com/1.1/followers/ids.json?count=50';
                $results = $twitteroauth->get($url);

//                debug($results);
                $array = null;
                $existe = null;
                $newarray = array_reverse($results->ids);
                $files = 0;
                foreach ($newarray as $id) {

                    $existe = $this->modelo_universal->select('automensaje', 'iduser', array('id_cuenta' => $idt, 'iduser ' => $id));
//si no esta en la base de datos lo guardo en un arreglo

                    if (!$existe && $files < 2) {
//                        debug($existe);
                        $array = $id . ',' . $array;
                        $files++;
//                lo agrego a la base de datos
//                        debug($this->db->last_query());
                    }
                }
                if ($array) {
//                busco a los 60 usuarios en $datos
                    $url = 'https://api.twitter.com/1.1/users/lookup.json';
                    $user = $twitteroauth->post($url, array('user_id' => $array));
//                empiezo a recorrer el arreglo de usuarios sacando su nombre y su last_name
                    $screen_name = null;

                    foreach ($user as $u) {
                        if (is_object($u)) {
//                remplazo el texto donde va usuario por el usuario y el name por el name
                            $message = str_replace(array('<*pktweetnameandlastname*>'), $u->name, $text);
                            $screen_name = '@' . $u->screen_name;
                            $message = str_replace(array('<*pktweetuser*>'), $screen_name, $message);
//                le envio el mensaje
//                               debug($message);
//                            $user = $twitteroauth->post($url, array('screen_name' => 'kevispk', 'text' => $message));
                            $url = 'https://api.twitter.com/1.1/direct_messages/new.json';
//                    $user = $twitteroauth->post($url, array('screen_name' => 'kevispk', 'text' => $message));
                            $user = $twitteroauth->post($url, array('user_id' => $u->id, 'text' => $message));
//                debug($user);
                            if (is_object($user) && !isset($user->errors)) {
                                $this->modelo_universal->insert('automensaje', array('id_cuenta' => $idt, 'iduser ' => $u->id));
                            }
                        }
                    }
//                debug($message);
                }
//        }
            }
        }
        $this->db->close();
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
        define('CONSUMER_KEY', 'RMJUIaiAJG6IaJVk25FS5lBVm');
        define('CONSUMER_SECRET', 'rPyu16cjxe3bbAUWIDr7szbFnTTuTPLTER3Nr2PKXffK0JnBfG');
        define('OAUTH_CALLBACK', 'http://pktweet.com/process');
    }

    public function consulta() {
        //funcion para consultar todos los tweets que no se han enviado
        $resultado = $this->data['noenviados'] = $this->modelo_universal->select('lista_ciclica', '*', array('estatus' => 0));
    }

}

?>