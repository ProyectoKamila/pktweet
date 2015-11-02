<?php
session_start();

class Controller extends CI_Controller {

    public $data = null;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'html'));
        $this->load->model('modelo_universal');
        $this->session();
    }

    public function index($mensaje = null) {
//if($mensaje==null){
//           $this->load->view('header');
//           $this->load->view('ups');
//            echo "Estamos en mantenimiento";
//            exit();
//       }
        if (!$this->user->conect) {
            $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
//            $this->load->view('header');
//            $this->load->view('account/index', $this->data);
            $this->load->view('minisite/header');
            $this->load->view('minisite/index');
            $this->load->view('minisite/footer');
//            $this->load->view('inicio', $this->data);
        } else {
            $idaccount = $this->user->information->id;
            if (isset($_GET["reset"])) {
                if ($_GET["reset"] == 1) {
                    header('Location: ./controller');
                }
            }
            $this->conection();
 
            $this->data['resultado'] = $this->modelo_universal->select('cuentas', '*', array('id_account' => $idaccount));
           //debug($this->data['resultado'] );
            if (!empty($this->data['resultado'])) {
                $resultado = $this->data['resultado'];
                $iden = $resultado[0]["id_cuenta"];
            } else {
                $resultado = NULL;
            }

//            debug($resultado[0]["id_cuenta"]);
            if ($resultado != NULL) {
                if (!$this->session->userdata('iden')) {
//                    $iden = $this->user->information->id . "0";
                    $this->session->set_userdata('iden', $iden);
                }
                $this->data['screenname'] = $screenname = $_SESSION['request_vars']['screen_name'] = $resultado[0]['screen_name'];
                $this->data['twitterid'] = $twitterid = $_SESSION['request_vars']['user_id'] = $resultado[0]['user_id'];
                $this->data['oauth_token'] = $oauth_token = $_SESSION['request_vars']['oauth_token'] = $resultado[0]['oauth_token'];
                $this->data['oauth_token_secret'] = $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'] = $resultado[0]['oauth_token_secret'];
                setcookie("oauth_token", $this->data['oauth_token'], 0, '/');
                setcookie("oauth_token_secret", $this->data['oauth_token_secret'], 0, '/');
                $this->data['verificar'] = $this->modelo_universal->select('cuentas', 'count(id_cuenta)', array('id_account' => $idaccount, 'screen_name' => $screenname));
                $verificar = $this->data['verificar'];
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
                $this->data['resultado'] = $resultado;
                $this->lista_ciclica($this->data['resultado'][0]['id_cuenta']);
                $this->data['cuentas'] = $this->modelo_universal->select('cuentas', 'count(*)', array('id_account' => $idaccount));
                $this->data['ctas'] = $this->modelo_universal->select('cuentas', '*', array('id_account' => $idaccount));
                $this->data['ctasthis'] = $this->modelo_universal->select('cuentas', '*', array('id_account' => $idaccount, 'id_cuenta' => $this->data['ctas'][0]['id_cuenta']));
                $this->data['widget'] = $this->modelo_universal->select('widget', '*', array('id_account' => $idaccount));
                $idtwet = $this->data['ctas'][0]['id_cuenta'];
                $this->data['cantwet'] = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $idtwet));
                $this->data['estatuslista'] = $this->modelo_universal->select('lista_ciclica', 'estatus,intervalo', array('id_cuenta' => $idtwet));
                $this->listdirectmessage($this->data['ctas'][0]['id_cuenta']);
                $this->data['idcuentatwitter'] = $this->data['ctas'][0]['id_cuenta'];
                $this->data['cupon'] = $this->cuponactivate($this->data['idcuentatwitter']);
                $this->retweet($this->data['idcuentatwitter']);
                $this->load->view('header');
                $this->load->view('index', $this->data);
            } else {
                redirect('./controller/process');
//                $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
//                $this->load->view('header');
//                $this->load->view('authorize', $this->data);
            }
        }
    }

    public function retweet($id_cuenta = null) {
        if ($this->user->conect && $id_cuenta <> null) {
            $this->data['retweet'] = $this->modelo_universal->select('retweet', '*', array('id_cuenta' => $id_cuenta));
        }
    }

    public function newretweet() {
        if ($this->user->conect) {
            $this->conection();
            $user = $this->modelo_universal->select('cuentas', 'oauth_token_secret,oauth_token', array('id_cuenta' => $this->input->post('id'), 'id_account' => $this->user->information->id));
            if ($user) {
                $tokken = $user[0]['oauth_token'];
                $tokensecret = $user[0]['oauth_token_secret'];
                $settings = array(
                    'oauth_access_token' => "$tokken",
                    'oauth_access_token_secret' => "$tokensecret",
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
                $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $tokken, $tokensecret);
                $url = 'https://api.twitter.com/1.1/users/lookup.json?screen_name=' . $this->input->post('d');
                $results = $twitteroauth->get($url);
//            debug($results[0]);
                if (is_array($results) && !isset($results[0]->errors)) {
                    $check = $this->modelo_universal->select('retweet', '*', array('id_cuenta' => $this->input->post('id'), 'retweet_cuenta' => $results[0]->id, 'id_account' => $this->user->information->id));
                    if (!$check) {
                        $this->modelo_universal->insert('retweet', array('id_cuenta' => $this->input->post('id'), 'retweet_cuenta' => $results[0]->id, 'id_account' => $this->user->information->id));
//                        debug($this->db->last_query());
                    }
                }
                $this->data['iden'] = $this->input->post('id');
                $this->retweet($this->input->post('id'));
                $this->load->view('kapp-tweet/retweet');
            }
        }
    }

    public function deleteretweet() {
        if ($this->user->conect) {
            $iden = $this->session->userdata('iden');
            $this->modelo_universal->delete('retweet', array('retweet_cuenta' => $this->input->post('d'), 'id_cuenta' => $this->input->post('id'), 'id_cuenta' => $iden));
            $this->data['iden'] = $this->input->post('id');
            $this->retweet($this->input->post('id'));
            $this->load->view('kapp-tweet/retweet');
        }
    }

    public function noseguidores($cuenta = null) {
        if ($this->user->conect && $cuenta != null) {
            $this->conection();
            $this->data['idcuenta'] = $cuenta;
            $this->data['ctas'] = $this->modelo_universal->select('cuentas', 'oauth_token, oauth_token_secret, id_cuenta', array('id_cuenta' => $cuenta, 'id_account' => $this->user->information->id));
            $this->unfollow($this->data['ctas'][0]['oauth_token'], $this->data['ctas'][0]['oauth_token_secret'], $this->data['ctas'][0]['id_cuenta']);
            $this->load->view('kapp-tweet/noseguidores');
        }
    }

    public function fans($cuenta = null) {
        if ($this->user->conect && $cuenta != null) {
            $this->conection();
            $this->data['idcuenta'] = $cuenta;
            $this->data['ctas'] = $this->modelo_universal->select('cuentas', 'oauth_token, oauth_token_secret, id_cuenta', array('id_cuenta' => $cuenta, 'id_account' => $this->user->information->id));
            $this->userfollow($this->data['ctas'][0]['oauth_token'], $this->data['ctas'][0]['oauth_token_secret'], $this->data['ctas'][0]['id_cuenta']);
            $this->load->view('kapp-tweet/fans');
        }
    }

    private function unfollow($tokken, $tokensecret, $id_cuenta) {
//string(50) "2421608558-bTLWJnlcVtOp56VHD1VNT8KnISm8qraBvyBSW6X"
//string(45) "yDZ8mUj1tL0mgW0jCY2W9glQcDDZgZNkcoAlLw8RD0xpy"
//string(10) "2421608558"
        $this->data['unfollow'] = array();
        $settings = array(
            'oauth_access_token' => "$tokken",
            'oauth_access_token_secret' => "$tokensecret",
            'consumer_key' => CONSUMER_KEY,
            'consumer_secret' => CONSUMER_SECRET
        );
        $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $tokken, $tokensecret);
        $url = 'https://api.twitter.com/1.1/users/lookup.json';

        $user = $twitteroauth->post($url, array('user_id' => $id_cuenta));
        $number = count($user[0]->friends_count) / 5000;
        $vueltas = 0;
        $cursor = 0;
        $arraymerge = array();
        while ($vueltas <= $number) {
            if ($cursor > 0) {

                $url = 'https://api.twitter.com/1.1/friends/ids.json?user_id=' . $id_cuenta . '&cursor=' . $cursor;
            } else {
                $url = 'https://api.twitter.com/1.1/friends/ids.json?user_id=' . $id_cuenta;
            }
            $results = $twitteroauth->get($url);
            $cursor = $cursor + 5000;
            if (isset($results->errors)) {
                echo "Ha excedido el numero de consultas a twitter,<br> intente en 10 minutos";
                ?>
                <article class="togg-article">

                    <div class="div">
                        <div class="twwet-text">
                            <div class="header">


                            </div>
                            <p class="twwet-text-p"> <a href="Javascript:fans(<?= $this->data['idcuenta'] ?>);">Cargar Seguidores que no sigo</a></p>
                        </div>

                    </div>
                </article>
                <?
                exit();
            }
            $arraymerge = array_merge($results->ids, $arraymerge);
            $vueltas++;
        }
        $r = 0;

        $number = count($arraymerge) / 100;
        if ($number > 1) {
            $number = 1;
        }
        for ($rate = 0; $rate <= $number; $rate++) {
            $string = '';
            $surge = $rate * 99;
            $surge2 = $surge + 99;
            for ($i = $surge; $i < $surge2; $i++) {
                if (isset($arraymerge[$i])) {
                    $string = $arraymerge[$i] . ',' . $string;
                }
            }


            if ($string) {

                $url = 'https://api.twitter.com/1.1/friendships/lookup.json?user_id=' . $string;

                $user = $twitteroauth->get($url);


                $this->data['true'] = false;
                foreach ($user as $u) {
                    if (is_object($u) && !isset($u->connections[1])) {
                        $this->data['true'] = true;
                        $this->data['unfollow'][$r] = $u->id_str;
                        $r++;
                    }
                }
            }
        }

        $r = 0;

        $count = count($this->data['unfollow']) / 100;

        for ($i1 = 0; $i1 <= $count; $i1++) {
            $stringid = '';
            $surge = $i1 * 99;
            $surge2 = $surge + 99;
            for ($i2 = $surge; $i2 < $surge2; $i2++) {
                if (isset($this->data['unfollow'][$i2])) {
                    $stringid = $this->data['unfollow'][$i2] . ',' . $stringid;
                }
            }

            $url = 'https://api.twitter.com/1.1/users/lookup.json';
            if ($stringid) {

                $user = $twitteroauth->post($url, array('user_id' => $stringid));
                if (is_array($user)) {
                    foreach ($user as $u) {
                        $this->data['nofollow'][$r]['image'] = $u->profile_image_url;
                        $this->data['nofollow'][$r]['id'] = $u->id;
                        $this->data['nofollow'][$r]['screen_name'] = $u->screen_name;
                        $this->data['nofollow'][$r]['name'] = $u->name;
                        $r++;
                    }
                }
            }
        }
    }

    private function userfollow($tokken, $tokensecret, $id_cuenta) {
//string(50) "2421608558-bTLWJnlcVtOp56VHD1VNT8KnISm8qraBvyBSW6X"
//string(45) "yDZ8mUj1tL0mgW0jCY2W9glQcDDZgZNkcoAlLw8RD0xpy"
//string(10) "2421608558"
        $this->data['userfollow'] = array();
        $settings = array(
            'oauth_access_token' => "$tokken",
            'oauth_access_token_secret' => "$tokensecret",
            'consumer_key' => CONSUMER_KEY,
            'consumer_secret' => CONSUMER_SECRET
        );
        $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $tokken, $tokensecret);
        $url = 'https://api.twitter.com/1.1/users/lookup.json';

        $user = $twitteroauth->post($url, array('user_id' => $id_cuenta));
        $number = count($user[0]->followers_count) / 5000;
        $vueltas = 0;
        $cursor = 0;
        $arraymerge = array();
        while ($vueltas <= $number) {
            if ($cursor > 0) {

                $url = 'https://api.twitter.com/1.1/followers/ids.json?user_id=' . $id_cuenta . '&cursor=' . $cursor;
            } else {
                $url = 'https://api.twitter.com/1.1/followers/ids.json?user_id=' . $id_cuenta;
            }
            $results = $twitteroauth->get($url);
            $cursor = $cursor + 5000;
            if (isset($results->errors)) {
                echo "Ha excedido el numero de consultas a twitter,<br> intente en 10 minutos";
                ?>
                <article class="togg-article">

                    <div class="div">
                        <div class="twwet-text">
                            <div class="header">


                            </div>
                            <p class="twwet-text-p"> <a href="Javascript:fans(<?= $this->data['idcuenta'] ?>);">Cargar Seguidores que no sigo</a></p>
                        </div>

                    </div>
                </article>
                <?
                exit();
            }
            $arraymerge = array_merge($results->ids, $arraymerge);
            $vueltas++;
        }
        $r = 0;

        $number = count($arraymerge) / 100;
        if ($number > 1) {
            $number = 1;
        }
        for ($rate = 0; $rate <= $number; $rate++) {
            $string = '';
            $surge = $rate * 99;
            $surge2 = $surge + 99;
            for ($i = $surge; $i < $surge2; $i++) {
                if (isset($arraymerge[$i])) {
                    $string = $arraymerge[$i] . ',' . $string;
                }
            }


            if ($string) {

                $url = 'https://api.twitter.com/1.1/friendships/lookup.json?user_id=' . $string;

                $user = $twitteroauth->get($url);


                $this->data['true'] = false;
                foreach ($user as $u) {
                    if (is_object($u) && $u->connections[0] != 'following' && $u->connections[0] != 'following_requested') {
                        $this->data['true'] = true;
                        $this->data['userfollow'][$r] = $u->id_str;
                        $r++;
                    }
                }
            }
        }

        $r = 0;

        $count = count($this->data['userfollow']) / 100;

        for ($i1 = 0; $i1 <= $count; $i1++) {
            $stringid = '';
            $surge = $i1 * 99;
            $surge2 = $surge + 99;
            for ($i2 = $surge; $i2 < $surge2; $i2++) {
                if (isset($this->data['userfollow'][$i2])) {
                    $stringid = $this->data['userfollow'][$i2] . ',' . $stringid;
                }
            }

            $url = 'https://api.twitter.com/1.1/users/lookup.json';
            if ($stringid) {

                $user = $twitteroauth->post($url, array('user_id' => $stringid));
                if (is_array($user)) {
                    foreach ($user as $u) {
                        $this->data['inofollow'][$r]['image'] = $u->profile_image_url;
                        $this->data['inofollow'][$r]['id'] = $u->id;
                        $this->data['inofollow'][$r]['screen_name'] = $u->screen_name;
                        $this->data['inofollow'][$r]['name'] = $u->name;
                        $r++;
                    }
                }
            }
        }
    }

    public function new_widget() {
        if ($this->input->post()) {
            $this->modelo_universal->insert('widget', array('widget' => $this->input->post('widget'), 'name' => $this->input->post('name'), 'id_account' => $this->user->information->id));
            redirect('./');
        }
    }

    public function delete_widget($id = null) {
        if ($id <> null) {
            $this->modelo_universal->delete('widget', array('id' => $id, 'id_account' => $this->user->information->id));
            redirect('./controller');
        }
    }

    public function cuentas() {
        $idaccount = $this->user->information->id;
        $this->data['cuentas'] = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name', array('id_account' => $idaccount));
        $this->load->view('cuentas', $this->data); //carga la vista
    }

    public function autorizar() {
        $this->load->view('header');
        $this->load->view('authorize'); //carga la vista
    }

    public function pr() {
        $this->load->view('minisite/header');
        $this->load->view('minisite/index');
        $this->load->view('minisite/footer');
//        
//        $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
////        debug("aqui");
//        header('Content-Type: text/html; charset=UTF-8');
//        ini_set('display_errors', 1);
//        $this->conection();
//        $screenname = $_SESSION['request_vars']['screen_name'];
//        $twitterid = $_SESSION['request_vars']['user_id'];
//        $oauth_token = '141013510-Dnx2vTT8JPDfEyfY89Ank24tfuIS6rUtHNu8a2tj';
//        $oauth_token_secret = 'H2BOYc35syAJBqQ5vTQ81hgMVXHoELOUMkHiJfl8VtIMZ';
//
//        $settings = array(
//            'oauth_access_token' => "$oauth_token",
//            'oauth_access_token_secret' => "$oauth_token_secret",
//            'consumer_key' => CONSUMER_KEY,
//            'consumer_secret' => CONSUMER_SECRET
//        );
//
//        $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
//        $url = 'https://api.twitter.com/1.1/statuses/update.json';
//        $results = $twitteroauth->post($url, array(
//            'status' => 'Haciendo pruebas de tweet automaticos en el nuevo kapptweet de @Proyectokmila #UnaVidaPk',
//            'display_coordinates' => 'false'
//        ));
    }

    public function view() {
        $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
        $this->load->view('account/index', $this->data);
    }

    public function eliminarcuenta() {
        $this->verifylogin();
        $id = $this->input->post('id');
        $select = $this->modelo_universal->select('cuentas', '*', array('id_cuenta' => $id, 'id_account' => $this->user->information->id));
        if ($select) {
            $this->modelo_universal->delete('cuentas', array('id_cuenta' => $id, 'id_account' => $this->user->information->id)); //elimina el tweet 
//            $this->modelo_universal->delete('tweet', array('id_cuenta' => $id)); //elimina el tweet 

            $this->modelo_universal->delete('lista_ciclica', array('id_ciclica' => $id)); //elimina el tweet 
        }
    }

    public function habilitar() {
        $id = $this->input->post('id'); //texto contenido en el tweet
        $habilitar = $this->input->post('hab'); //texto contenido en el tweet
        settype($id, 'int');
        settype($habilitar, 'int');
        if ($habilitar == 1) {
//si esta habilitado se deshabilita cambiando su estado en la base de datos
            $this->modelo_universal->update('tweet', array('posicion' => 0, 'habilitar' => 0), array('id_twett' => $id));
        } else {
//si esta deshabilitado se habilita cambiando su estado en la base de datos
            $this->modelo_universal->update('tweet', array('habilitar' => 1), array('id_twett' => $id));
        }//fin del else
        $identificadores = $this->modelo_universal->select('tweet', 'id_cuenta,id_user,id_lista', array('id_twett' => $id)); //selecciona los demas identificadores
        $cuenta = $identificadores[0]['id_cuenta']; // almacena el id de la cuenta
        $lista = $identificadores[0]['id_lista']; // almacena el id de la lista ciclica
        $user = $identificadores[0]['id_user']; //almacena el id del usuario
        $contador = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $cuenta, 'id_lista' => $lista, 'id_user' => $user, 'habilitar' => 1)); // cuanta la cantidad de de tweets
        $twet = $this->modelo_universal->select('tweet', '*', array('id_cuenta' => $cuenta, 'id_lista' => $lista, 'id_user' => $user, 'habilitar' => 1), null, null, 'posicion', 'DESC'); //selecciona toda la informacion de todos los tweet
        $cont = $contador[0]['count(*)']; //almacena el contador
        settype($cont, 'int'); //cambia el formato a entero
        $i = 0; // inicializa el contador i en cero

        for ($i = 0; $i < $cont; $i++) {
            $idt = $twet[$i]['id_twett']; //selecciona el id de cada tweet
            $this->modelo_universal->update('tweet', array('posicion' => $i + 1), array('id_twett' => $idt, 'habilitar' => 1)); //actualiza cada tweet con su nueva posicion
        }// fin del for
        $hab = $this->modelo_universal->select('tweet', 'id_twett,habilitar', array('id_twett' => $id));
        if ($hab[0]['habilitar'] === '1') {
            echo '<a href="javascript:habilitar(' . $hab[0]['id_twett'] . ',' . $hab[0]['habilitar'] . ')"class="icon icon2-remove"></a>';
        } else {
            echo '<a href="javascript:habilitar(' . $hab[0]['id_twett'] . ',' . $hab[0]['habilitar'] . ')"class="icon icon-check"></a>';
        }
    }

    public function cyclic() {
//        debug($this->session->userdata('iden'));
        $iden = $this->session->userdata('iden');
//        debug($iden);
        $idaccount = $this->user->information->id;
        $texto = $this->input->post('twit'); //texto contenido en el tweet
        if ($this->input->post('tweet')) {
            $cuenta = $this->modelo_universal->select('cuentas', 'oauth_token,oauth_token_secret', array('id_cuenta' => $iden, 'id_account' => $idaccount));
            $oauth_token = $cuenta[0]['oauth_token'];
            $oauth_token_secret = $cuenta[0]['oauth_token_secret'];
            $this->conection();

            $mjs = $texto;
            $settings = array(
                'oauth_access_token' => "$oauth_token",
                'oauth_access_token_secret' => "$oauth_token_secret",
                'consumer_key' => CONSUMER_KEY,
                'consumer_secret' => CONSUMER_SECRET
            );
            $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

            $url = 'https://api.twitter.com/1.1/statuses/update.json';
            $results = $twitteroauth->post($url, array(
                'status' => $mjs,
                'display_coordinates' => 'false'
            ));
            //  if(isset($_get['debug'])){
            //debug($results);
            //}
        }

        $contador = $this->modelo_universal->select('tweet', 'count(id_twett)', array('id_cuenta' => $iden, 'id_lista' => $iden));
        $cont = $contador[0]['count(id_twett)'];
        settype($cont, 'int');
        $cont = $cont + 1;
//        $verf=$this->verificartweet($texto,$iden);
        $val = $this->modelo_universal->select('tweet', 'count(id_twett)', array('id_cuenta' => $iden, 'texto' => $texto));
        if ($val[0]['count(id_twett)'] == '1') {
//mensaje
            echo 'fallo';
        } else {

            $this->modelo_universal->insert('tweet', array('id_twett' => 0, 'texto' => $texto, 'id_cuenta' => $iden, 'id_user' => $idaccount, 'id_lista' => $iden, 'posicion' => $cont, 'estatus' => 0, 'habilitar' => 1));
            echo $cont;
        }
//        debug($cont[0]['count(id_twett)']);
//        $this->data['verificacion_de_tweet']=$verf;

        $this->data['iden'] = $iden;
        $this->data['tweet'] = $select = $this->modelo_universal->select('tweet', '*', array('id_cuenta' => $iden, 'id_lista' => $iden), null, null, 'posicion', 'DESC');

//       $this->load->view('listas', $this->data); //se carga la vista con todos los datos recogidos
    }

    public function eliminart() {
        $iden = $this->session->userdata('iden');
        $id = $this->input->post('id'); //texto contenido en el tweet
        settype($id, 'int'); //convierte en entero el ind que ingresa siendo string

        $identificadores = $this->modelo_universal->select('tweet', 'id_cuenta,id_user,id_lista', array('id_twett' => $id)); //obtiene usando el id del tweet los demas id

        $cuenta = $identificadores[0]['id_cuenta']; //agrega en una variable el id de la cuenta
        $lista = $identificadores[0]['id_lista']; //agrega en una variable el id de la lista
        $user = $identificadores[0]['id_user']; // agrega en una variable el id del usuario

        $this->modelo_universal->delete('tweet', array('id_twett' => $id, 'id_cuenta' => $iden)); //elimina el tweet
        $contador = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $cuenta, 'id_lista' => $lista, 'id_user' => $user, 'habilitar' => 1)); //cuenta la cantidad de tweet habilitados hay
        $twet = $this->modelo_universal->select('tweet', '*', array('id_cuenta' => $cuenta, 'id_lista' => $lista, 'id_user' => $user, 'habilitar' => 1), null, null, 'posicion', 'DESC'); //agrega en una variable todos los tweets que estan habilitados

        $cont = $contador[0]['count(*)']; // agrega en uan variable la cantidad de twets
        settype($cont, 'int'); //convierte la variable en entero

        $i = 0; //inicializa la variable i
        for ($i = 0; $i < $cont; $i++) { //recorre todos los valores 
            $idt = $twet[$i]['id_twett']; // obtiene el id de cada tweet
            $this->modelo_universal->update('tweet', array('posicion' => $i + 1), array('id_twett' => $idt, 'habilitar' => 1)); //modifica la posicion de los tweets en la lista ciclica
        }// fin del for
    }

    public function elimdirect() {
        if ($this->user->conect) {
            $iden = $this->session->userdata('iden');
            $this->modelo_universal->delete('directmessage', array('id' => $this->input->post('id'), 'id_cuenta' => $iden));
        }
    }

    public function guardartweet() {
        if ($this->input->post()) {
            $texto = $this->input->post('twit1'); //texto contenido en el tweet
            $texto = strip_tags($texto);
            if (empty($texto) || $texto == null) {
                $texto = "Error al Editar Texto";
            }
            $idusert = $this->input->post('idusert'); //texto contenido en el tweet
            $true = $this->modelo_universal->update('tweet', array('texto' => $texto), array('id_twett' => $idusert));
        }
    }

    public function lista_ciclica($id) {
        $idaccount = $this->user->information->id;
        $this->data['tweet'] = $select = $this->modelo_universal->select('tweet', '*', array('id_cuenta' => $id, 'id_lista' => $id), null, null, 'id_twett', 'DESC');
        $this->data['iden'] = $id;
        $this->data['nombre'] = $select = $this->modelo_universal->select('cuentas', 'nombre', array('id_cuenta' => $id, 'id_account' => $idaccount));
        $this->data['intervalo'] = $select = $this->modelo_universal->select('lista_ciclica', 'intervalo', array('id_ciclica' => $id));
        $this->data['cantwet'] = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $id));
        $this->data['estatuslista'] = $this->modelo_universal->select('lista_ciclica', 'estatus,intervalo', array('id_cuenta' => $id));
        $select = $this->modelo_universal->select('cuentas', 'screen_name', array('id_cuenta' => $id, 'id_account' => $idaccount));
        if ($select) {
            $this->data['screenname'] = $select[0]['screen_name'];
        }
    }

    public function actualizar($id) {
        $this->verifylogin();
        $idaccount = $this->user->information->id;
        $this->session->set_userdata('iden', $id);
        $this->data['cuentas'] = $this->modelo_universal->select('cuentas', 'count(*)', array('id_account' => $idaccount));
        $this->data['ctas'] = $this->modelo_universal->select('cuentas', '*', array('id_account' => $idaccount));
        $this->data['ctasthis'] = $this->modelo_universal->select('cuentas', '*', array('id_account' => $idaccount, 'id_cuenta' => $id));
        $this->data['widget'] = $this->modelo_universal->select('widget', '*', array('id_account' => $idaccount));
        if (isset($this->data['ctas'][0]['id_cuenta']) && $this->data['ctasthis']) {
            $this->lista_ciclica($id);
            $idtwet = $this->data['ctas'][0]['id_cuenta'];
            $idcuenta = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name,oauth_token,oauth_token_secret', array('id_account' => $idaccount, 'id_cuenta' => $id));

            $this->data['cantwet'] = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $idtwet));
            $this->data['estatuslista'] = $this->modelo_universal->select('lista_ciclica', 'estatus,intervalo', array('id_cuenta' => $idcuenta[0]['id_cuenta']));
            $this->conection();
            $this->data['cupon'] = $this->cuponactivate($id);
//            debug($id);
            $this->data['idcuentatwitter'] = $id;
            $this->retweet($this->data['idcuentatwitter']);
            $this->listdirectmessage($id);
        }
        $this->load->view('header');
        $this->load->view('index', $this->data);
    }

    public function listdirect($id) {
//    debug($id);
        $this->listdirectmessage($id);
        $this->load->view('kapp-tweet/listdirect');
    }

    public function nofollow() {
        $idaccount = $this->input->post('idaccount');
        $id = $this->input->post('id');
        if ($this->user->conect) {
            $user = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name,oauth_token,oauth_token_secret,seguidores,fecha_f', array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
            if ($user) {
                $fecha = strtotime($user[0]['fecha_f']);
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date);
                $bol = false;
                if ($today < $fecha) {
                    $bol = true;
                } elseif ($user[0]['seguidores'] > 0) {
                    $bol = true;
                }
                if (!$bol) {
                    exit();
                }
                $this->conection();
                $settings = array(
                    'oauth_access_token' => $user[0]['oauth_token'],
                    'oauth_access_token_secret' => $user[0]['oauth_token_secret'],
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
                $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user[0]['oauth_token'], $user[0]['oauth_token_secret']);
                $seguidores = $user[0]['seguidores'] - 1;
                $this->modelo_universal->update('cuentas', array('seguidores' => $seguidores), array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
                $url = 'https://api.twitter.com/1.1/friendships/destroy.json';
                $results = $twitteroauth->post($url, array('user_id' => $id));
            }
        }
    }

    public function nofollowall() {
        $idaccount = $this->input->post('idaccount');
        $id = explode(',', $this->input->post('id'));

        $count = count($id);
        if ($this->user->conect) {
            $user = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name,oauth_token,oauth_token_secret,seguidores,fecha_f', array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
            if ($user) {
                $fecha = strtotime($user[0]['fecha_f']);
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date);
                $bol = false;
                $vip = false;
                if ($today < $fecha) {
                    $bol = true;
                } elseif ($user[0]['seguidores'] > $count) {
                    $bol = true;
                }
                if (!$bol) {
                    echo "fallo";
                    exit();
                }
                $this->conection();
                $settings = array(
                    'oauth_access_token' => $user[0]['oauth_token'],
                    'oauth_access_token_secret' => $user[0]['oauth_token_secret'],
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
                $seguidores = $user[0]['seguidores'] - $count;
                $this->modelo_universal->update('cuentas', array('seguidores' => $seguidores), array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
                $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user[0]['oauth_token'], $user[0]['oauth_token_secret']);
                foreach ($id as $id) {
                    $url = 'https://api.twitter.com/1.1/friendships/destroy.json';
                    $results = $twitteroauth->post($url, array('user_id' => $id));
                }
                if ($vip == true) {
                    echo 9999;
                } else {
                    echo $seguidores;
                }
            }
        }
    }

    public function followuserall() {
        $idaccount = $this->input->post('idaccount');
        $id = $this->input->post('id');
        $id = explode(',', $this->input->post('id'));

        $count = count($id);
        if ($this->user->conect) {
            $user = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name,oauth_token,oauth_token_secret,fans,fecha_f', array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
            if ($user) {
                $fecha = strtotime($user[0]['fecha_f']);
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date);
                $bol = false;
                $vip = false;
                if ($today < $fecha) {
                    $bol = true;
                } elseif ($user[0]['fans'] > $count) {
                    $bol = true;
                }
                if (!$bol) {
                    exit();
                }
                $this->conection();
                $settings = array(
                    'oauth_access_token' => $user[0]['oauth_token'],
                    'oauth_access_token_secret' => $user[0]['oauth_token_secret'],
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
                $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user[0]['oauth_token'], $user[0]['oauth_token_secret']);
                $fans = $user[0]['fans'] - $count;
                $this->modelo_universal->update('cuentas', array('fans' => $fans), array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
                foreach ($id as $id) {
                    $url = 'https://api.twitter.com/1.1/friendships/create.json';
                    $results = $twitteroauth->post($url, array('user_id' => $id));
                }
                if ($vip == true) {
                    echo 9999;
                }
                else
                    echo $fans;
            }
        }
    }

    public function followuser() {
        $idaccount = $this->input->post('idaccount');
        $id = $this->input->post('id');
        if ($this->user->conect) {
            $user = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name,oauth_token,oauth_token_secret,fans,fecha_f', array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
            if ($user) {
                $fecha = strtotime($user[0]['fecha_f']);
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date);
                $bol = false;
                if ($today < $fecha) {
                    $bol = true;
                } elseif ($user[0]['fans'] > 0) {
                    $bol = true;
                }
                if (!$bol) {
                    exit();
                }
                $this->conection();
                $settings = array(
                    'oauth_access_token' => $user[0]['oauth_token'],
                    'oauth_access_token_secret' => $user[0]['oauth_token_secret'],
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
                $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user[0]['oauth_token'], $user[0]['oauth_token_secret']);
                $fans = $user[0]['fans'] - 1;
                $this->modelo_universal->update('cuentas', array('fans' => $fans), array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
                $url = 'https://api.twitter.com/1.1/friendships/create.json';
                $results = $twitteroauth->post($url, array('user_id' => $id));
            }
        }
    }

    public function followusersearchall() {
        $idaccount = $this->input->post('idaccount');
        $id = $this->input->post('id');
        $id = explode(',', $this->input->post('id'));

        $count = count($id);
        if ($this->user->conect) {
            $user = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name,oauth_token,oauth_token_secret,cpseguidores,fecha_f', array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
            if ($user) {
                $fecha = strtotime($user[0]['fecha_f']);
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date);
                $bol = false;
                $vip = false;
                if ($today <= $fecha) {
                    $bol = true;
                    $vip = true;
                } elseif ($user[0]['cpseguidores'] > $count) {
                    $bol = true;
                }
                if (!$bol) {
                    exit();
                }
                $this->conection();
                $settings = array(
                    'oauth_access_token' => $user[0]['oauth_token'],
                    'oauth_access_token_secret' => $user[0]['oauth_token_secret'],
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
                $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user[0]['oauth_token'], $user[0]['oauth_token_secret']);
                foreach ($id as $id) {
                    $url = 'https://api.twitter.com/1.1/friendships/create.json';
                    $results = $twitteroauth->post($url, array('user_id' => $id));
                }
                $cpseguidores = $user[0]['cpseguidores'] - $count;
                $this->modelo_universal->update('cuentas', array('cpseguidores' => $cpseguidores), array('id_account' => $this->user->information->id, 'id_cuenta' => $idaccount));
                if ($vip == true) {
                    echo 99999;
                } else {
                    echo $cpseguidores;
                }
            }
        }
    }

    private function listdirectmessage($id = null) {
        if ($this->user->conect) {
            $this->data['directmessage'] = $this->modelo_universal->select('directmessage', 'id,message', array('id_cuenta' => $id), null, null, 'id', 'DESC');
        }
    }

    public function directmessage() {
        if ($this->user->conect) {
            $check = $this->modelo_universal->select('cuentas', 'id_cuenta,fecha_f', array('id_cuenta' => $this->input->post('id'), 'id_account' => $this->user->information->id));

            if ($check) {
                $fecha = strtotime($check[0]['fecha_f']);
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date);
                $bol = false;
                if ($today < $fecha) {
                    $bol = true;
                }
                if ($bol) {
                    $message = $this->input->post('direct');
                } else {
                    $message = $this->input->post('direct') . ' -uso @PKtweet_';
                }
                $this->modelo_universal->insert('directmessage', array('id_cuenta' => $this->input->post('id'), 'idaccount' => $this->user->information->id, 'message' => $message));
//            debug($this->db->last_query());
            }
        }
    }

    public function process() {
        $this->config();
              $idaccount = $this->user->information->id;

        require_once('./application/libraries/twitteroauth.php');
if (isset($_GET['oauth_token']) && $_SESSION['token'] == $_GET['oauth_token']) {
// everything looks good, request access token
//successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'], $_SESSION['token_secret']);
            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            if ($connection->http_code == '200') {
//redirect user to twitter
              
                $_SESSION['status'] = 'verified';
                $_SESSION['request_vars'] = $access_token;

                      $name = $this->user->information->name;
                $s = explode(' ', $name);
                $namel = $this->user->information->last_name;
                $sl = explode(' ', $namel);
                $name_c = $s[0] . " " . $sl[0];
                $this->data['screenname'] = $screenname = $_SESSION['request_vars']['screen_name'];
                $this->data['twitterid'] = $twitterid = $_SESSION['request_vars']['user_id'];
                $this->data['oauth_token'] = $oauth_token = $_SESSION['request_vars']['oauth_token'];
                $this->data['oauth_token_secret'] = $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
                settype($idaccount, 'string');
                unset($_SESSION['status']);
                setcookie("oauth_token", $this->data['oauth_token'], 0, '/');
                setcookie("oauth_token_secret", $this->data['oauth_token_secret'], 0, '/');
                $contador = $this->modelo_universal->select('cuentas', 'count(*)', array('id_account' => $idaccount)); // cuanta la cantidad de de tweets
                $contador = $contador[0]['count(*)'];
                settype($contador, 'String');
                $iden = $twitterid;
                $this->session->set_userdata('iden', $iden);
                settype($idaccount, 'int');
                settype($contador, 'int');
                $nombre = $this->modelo_universal->select('cuentas', 'screen_name', array('id_account' => $idaccount, 'screen_name' => $screenname));
                //$select = $this->modelo_universal->select('cuentas', 'fecha_f', array('id_cuenta' => $twitterid,'id_account' => $idaccount));
                $select = $this->modelo_universal->select('cuentas', 'fecha_f', array('id_cuenta' => $twitterid,'id_account !=' => $idaccount));
                //$this->modelo_universal->delete('cuentas', array('id_cuenta' => $twitterid, 'id_account' => $idaccount)); //elimina el tweet 
                //$this->modelo_universal->delete('lista_ciclica', array('id_ciclica' => $twitterid)); //elimina el tweet 
                if(!empty($select)){
                    //debug($select);
                }
                //debug('fin');
                //if ($select) {
                if((empty($select)) or ($select)){
                    
                    $fecha_f = $select[0]['fecha_f'];
                    $query = $this->db->query("INSERT INTO cuentas (id_cuenta, oauth_token,oauth_token_secret,user_id, screen_name, nombre, id_account,fecha_f) VALUES ('$twitterid','$oauth_token','$oauth_token_secret','$twitterid','$screenname','$name_c','$idaccount','$fecha_f')");
                    $query = $this->db->query("INSERT INTO lista_ciclica (id_ciclica, id_cuenta,intervalo) VALUES ('$twitterid','$twitterid','10')");
                    $query = $this->modelo_universal->update('cuentas', array('oauth_token' => $_SESSION['request_vars']['oauth_token'], 'oauth_token_secret' => $_SESSION['request_vars']['oauth_token_secret']), array('id_cuenta' => $twitterid));
                    
                } else{


                $select = $this->modelo_universal->select('cuentas', 'fecha_f', array('id_cuenta' => $twitterid,'id_account' => $idaccount));
                //if($select) {
                if(!empty($select)){
                $query = $this->modelo_universal->update('cuentas', array('oauth_token' => $_SESSION['request_vars']['oauth_token'], 'oauth_token_secret' => $_SESSION['request_vars']['oauth_token_secret']), array('id_cuenta' => $twitterid,'id_account' => $idaccount));
                    //$query = $this->db->query("INSERT INTO cuentas (id_cuenta, oauth_token,oauth_token_secret,user_id, screen_name, nombre, id_account) VALUES ('$twitterid','$oauth_token','$oauth_token_secret','$twitterid','$screenname','$name_c','$idaccount')");
                
                }
                }
                $this->tweet($screenname, $oauth_token, $oauth_token_secret);

//                $this->data['resultado'] = $resultado;
                unset($_SESSION['token']);
                unset($_SESSION['token_secret']);
                       header('Location: ./');
                
                
// unset no longer needed request tokens
//        debug("rrr");
            } else {
                die("error, try again later!");
            }
        } else {

            if (isset($_GET["denied"])) {

                header('Location: ./');
                die();
            }

//fresh authentication
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
            $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

//received token info from twitter
            $_SESSION['token'] = $request_token['oauth_token'];
//            debug($_SESSION['token']);
            $_SESSION['token_secret'] = $request_token['oauth_token_secret'];

// any value other than 200 is failure, so continue only if http code is 200
            if ($connection->http_code == '200') {
//redirect user to twitter
                $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);

                header('Location: ' . $twitter_url);
            } else {
                die("error connecting to twitter! try again later!");
            }
        }
    }

    public function content() {
        $this->load->view("kapp-tweet/content");
    }

    public function verify() {
        if (!isset($_REQUEST['oauth_token'])) {
            redirect("./controller/verify?oauth_token=jIOXKzYELWdfYgk2nXFiIHAz58GeINBvnqlVIfRb8&oauth_verifier=pacFbZNB9yXnU8Hp2jrIXMu29wJd9BdgnUQRC8EB7Ek");
        }

        $this->config();
        require_once('./application/libraries/twitteroauth.php');
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->getRequestToken(OAUTH_CALLBACK);
    }

    public function vr() {

        header('Content-Type: text/html; charset=UTF-8');
        ini_set('display_errors', 1);
        $this->conection();
        $screenname = $_SESSION['request_vars']['screen_name'];
        $twitterid = $_SESSION['request_vars']['user_id'];
        $oauth_token = '141013510-Dnx2vTT8JPDfEyfY89Ank24tfuIS6rUtHNu8a2tj';
        $oauth_token_secret = 'H2BOYc35syAJBqQ5vTQ81hgMVXHoELOUMkHiJfl8VtIMZ';

        $settings = array(
            'oauth_access_token' => "$oauth_token",
            'oauth_access_token_secret' => "$oauth_token_secret",
            'consumer_key' => CONSUMER_KEY,
            'consumer_secret' => CONSUMER_SECRET
        );

        $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
        $url = 'https://api.twitter.com/1.1/followers/ids.json';
        $results = $twitteroauth->get($url, array(
            'screen_name' => 'jfigueroaubv',
        ));
        debug($results);
    }

    public function editar() {
        $id = $_GET["id"]; //obtiene por metodo get el id del tweet
        settype($id, 'int'); //convierte en entero el ind que ingresa siendo string
        $this->data['editar'] = $this->modelo_universal->select('tweet', 'texto', array('id_twett' => $id)); //cuenta la cantidad de tweet habilitados hay
        $this->data['id'] = $id;
        $this->load->view('editar', $this->data); //carga la vista
    }

    public function listas() {
        if (!$this->user->conect || !$this->session->userdata('iden')) {
            echo "Ha expirado el tiempo de espera,Por favor refresque la pagina con f5";
        } else {
            $iden = $this->session->userdata('iden');
//            $idaccount = $this->user->information->id;
            $select = $this->modelo_universal->select('cuentas', 'screen_name', array('id_cuenta' => $iden));
//debug($select);
            if ($select) {
                $this->data['screenname'] = $select[0]['screen_name'];
                $this->data['cantwet'] = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $iden));
                $this->data['estatuslista'] = $this->modelo_universal->select('lista_ciclica', 'estatus', array('id_cuenta' => $iden));
                $this->data['intervalo'] = $select = $this->modelo_universal->select('lista_ciclica', 'intervalo', array('id_ciclica' => $iden));
                $this->data['iden'] = $iden;
                $this->data['tweet'] = $this->modelo_universal->select('tweet', '*', array('id_cuenta' => $iden, 'id_lista' => $iden), 1, 0, 'posicion', 'DESC'); //selecciona los tweets
                $this->load->view('tweets', $this->data); //carga la vista
            }
        }
    }

    public function uri() {
        $uri = './';
        redirect($uri);
    }

    public function salir() {
        session_destroy();
        $this->session->sess_destroy();
        $uri = 'http://pkaccount.com/p/close.php?url=7&ip=' . $_COOKIE['ip'];
        redirect($uri);
    }

    private function session() {
        $config['tokken'] = '40d89a135e0e68cc8896dd301b65352E';
        $config['tag'] = true;
        $this->load->library('user', $config);
        if ($this->session->userdata('iden')) {
            $id = $this->session->userdata('iden');
            $this->session->set_userdata('iden', $id);
        }
    }

    public function search() {

        if ($this->user->conect) {
            $user = $this->input->post('d');

            $id = $this->user->information->id;
            $idcuenta = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name,oauth_token,oauth_token_secret', array('id_account' => $id, 'id_cuenta' => $this->input->post('id')));
//            debug($this->db->last_query());
//string(50) "2421608558-bTLWJnlcVtOp56VHD1VNT8KnISm8qraBvyBSW6X"
//string(45) "yDZ8mUj1tL0mgW0jCY2W9glQcDDZgZNkcoAlLw8RD0xpy"
//string(10) "2421608558"
            if (!$idcuenta) {
                exit();
            }
            $this->data['iden'] = $this->input->post('id');
            $this->data['userfollow'] = array();
            $this->conection();
            $settings = array(
                'oauth_access_token' => $idcuenta[0]['oauth_token'],
                'oauth_access_token_secret' => $idcuenta[0]['oauth_token_secret'],
                'consumer_key' => CONSUMER_KEY,
                'consumer_secret' => CONSUMER_SECRET
            );
            $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $idcuenta[0]['oauth_token'], $idcuenta[0]['oauth_token_secret']);

            $url = 'https://api.twitter.com/1.1/followers/ids.json?screen_name=' . $user . '&count=1440';
            $results = $twitteroauth->get($url);
            $r = 0;
            if (isset($results->ids)) {
                $number = count($results->ids) / 100;
                if ($number > 2) {
                    $number = 1;
                }
                for ($rate = 0; $rate <= $number; $rate++) {
                    $string = '';
                    $surge = $rate * 99;
                    $surge2 = $surge + 99;
                    for ($i = $surge; $i < $surge2; $i++) {
                        if (isset($results->ids[$i])) {
                            $string = $results->ids[$i] . ',' . $string;
                        }
                    }


                    if ($string) {

                        $url = 'https://api.twitter.com/1.1/friendships/lookup.json?user_id=' . $string;

                        $user = $twitteroauth->get($url);

                        if (isset($user->errors)) {
                            echo "el limite de solicitudes a twitter,<br>ha excedido en su cuenta<br>consulte en un rato";
                            exit();
                        }

                        foreach ($user as $u) {
//                        if (isset($_GET)) {
//                                debug($user);
//                            }
                            if (is_object($u) && isset($u->connections[0]) && $u->connections[0] !== "following" && $u->connections[0] !== "followed_by" && $u->connections[0] !== "following_requested") {
                                $this->data['userfollow'][$r] = $u->id_str;
                                $r++;
                            }
                        }
                    }
                }

                $r = 0;

                $count = count($this->data['userfollow']) / 100;

                $find = false;
                for ($i1 = 0; $i1 <= $count; $i1++) {
                    $stringid = '';
                    $surge = $i1 * 99;
                    $surge2 = $surge + 99;
                    for ($i2 = $surge; $i2 < $surge2; $i2++) {
                        if (isset($this->data['userfollow'][$i2])) {
                            $stringid = $this->data['userfollow'][$i2] . ',' . $stringid;
                        }
                    }

                    $url = 'https://api.twitter.com/1.1/users/lookup.json';
                    if ($stringid) {

                        $user = $twitteroauth->post($url, array('user_id' => $stringid));

                        foreach ($user as $u) {
                            $find = true;
                            $this->data['inofollow'][$r]['image'] = $u->profile_image_url;
                            $this->data['inofollow'][$r]['id'] = $u->id;
                            $this->data['inofollow'][$r]['screen_name'] = $u->screen_name;
                            $this->data['inofollow'][$r]['name'] = $u->name;
                            $r++;
                        }
                    }
                }
                if ($find) {
//            debug($this->data['inofollow']);
                    $this->load->view('kapp-tweet/search', $this->data);
                } else {
                    echo "Usuario no encontrado!!";
                }
            } else {
                echo "no se ha encontrado ó el limite de solicitudes a twitter,<br>ha excedido en su cuenta<br>consulte en un rato";
            }

//        $sss ="40018037";
//        $url = 'https://api.twitter.com/1.1/users/lookup.json';
//        $user = $twitteroauth->post($url, array('user_id' => $sss));
//
//        $this->data['results1'];
//
//         debug($results1);
//        $this->load->view('search', $this->data['results1']);
        }
    }

    public function tweet($screenname, $oauth_token, $oauth_token_secret) {
//        debug($screenname, false);
//        debug($oauth_token, false);
//        debug($oauth_token_secret);
        $this->conection();

        $mjs = 'Bienvenidos a @Pktweet_ y a #UnaVidaPk, gestiono mi Twitter con #PkTweet lo recomiendo es genial. ';
        $settings = array(
            'oauth_access_token' => "$oauth_token",
            'oauth_access_token_secret' => "$oauth_token_secret",
            'consumer_key' => CONSUMER_KEY,
            'consumer_secret' => CONSUMER_SECRET
        );
        $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $results = $twitteroauth->post($url, array(
            'status' => $mjs,
            'display_coordinates' => 'false'
        ));
        $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, '2608859466-7IJKmoOL2Y8dEfYZ43zom1LkQ65d0ukA5SjsvZM', 'CojKrvB2K2gRYmIaWKBhlreFnD29cCNh8ybRoRG2hx6vr');
        $mjs = 'Le damos la Bienvenida a @' . $screenname . ' por usar www.pktweet.com';

        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $results = $twitteroauth->post($url, array(
            'status' => $mjs,
            'display_coordinates' => 'false'
        ));

        $url = 'https://api.twitter.com/1.1/friendships/create.json';
        $results = $twitteroauth->post($url, array('screen_name' => $screenname));
    }

    private function verifylogin() {
        if (!$this->user->conect) {
            redirect('./');
        }
    }

    private function config() {
//          LOCAL---------------------------------------------------------
//        define('CONSUMER_KEY', 'uZVld72gVQlyWlLmq2JvQlEXy');
//        define('CONSUMER_SECRET', 'GsnVPoHtp4JgxBgLgznJ0sakBAwRRcPgyXuxiUsBKvc14JtiQX');
//        define('OAUTH_CALLBACK', 'http://localhost/pktweetsvn/process');
//        SERVIDOR-----------------------------------------------------------------
          define('CONSUMER_KEY', 'RMJUIaiAJG6IaJVk25FS5lBVm');
        define('CONSUMER_SECRET', 'rPyu16cjxe3bbAUWIDr7szbFnTTuTPLTER3Nr2PKXffK0JnBfG');
        define('OAUTH_CALLBACK', 'http://pktweet.com/process');
    }

    private function conection() {
        $this->config();
        require_once('./application/libraries/twitteroauth.php');
        require_once('./application/libraries/TwitterAPIExchange.php');
    }

    public function iconos() {
        $this->load->view('iconos');
    }

    public function cal() {
        $this->load->view('calendario');
    }

    public function headcta() {
        $iden = $this->session->userdata('iden');
        $select = $this->modelo_universal->select('cuentas', 'screen_name', array('id_cuenta' => $iden));
        $this->data['screenname'] = $select[0]['screen_name'];
        $this->data['cantwet'] = $this->modelo_universal->select('tweet', 'count(*)', array('id_cuenta' => $iden));
        $this->data['estatuslista'] = $this->modelo_universal->select('lista_ciclica', 'estatus', array('id_cuenta' => $iden));
        $this->data['intervalo'] = $select = $this->modelo_universal->select('lista_ciclica', 'intervalo', array('id_ciclica' => $iden));
    }

    public function intervalo($id = NULL) {
        if ($this->input->post('intervalo') && $this->user->conect) {
            $intervalo = $this->input->post('intervalo');
//        debug($intervalo);
            $id_cuenta = $this->modelo_universal->select('cuentas', 'id_cuenta', array('id_account' => $this->user->information->id, 'id_cuenta' => $id));
            $this->modelo_universal->update('lista_ciclica', array('intervalo' => $intervalo), array('id_cuenta' => $id_cuenta[0]['id_cuenta']));
        }
    }

    public function activarlista($id = NULL, $estatus = NULL) {
        if ($estatus === '0') {
            $this->modelo_universal->update('lista_ciclica', array('estatus' => 1), array('id_cuenta' => $id));
        } else {
            $this->modelo_universal->update('lista_ciclica', array('estatus' => 0), array('id_cuenta' => $id));
        }
    }

    public function verificartweet($texto, $id) {
//        debug($texto);
//        $contador = $this->modelo_universal->select('tweet', 'count(id_twett)', array('id_cuenta' => $id, 'texto' => $texto));
        $contador = $this->modelo_universal->query('SELECT count(id_twett) FROM tweet where texto = _"' . $texto . '"_ AND id_cuenta=' . $id);
//        debug($contador);
        return($contador);
    }

    public function cuponactivate($cuenta) {
        if ($this->user->conect) {
            $today = date('Y-m-d');
            $date = $this->modelo_universal->select('cuentas', 'fecha_f', array('id_cuenta' => $cuenta, 'id_account' => $this->user->information->id, 'fecha_f >=' => $today));
            if ($date) {
                $fecha = strtotime($date[0]['fecha_f']) - strtotime($today);
                $fecha = intval($fecha / 60 / 60 / 24);
//                debug($fecha);

                return $fecha;
            }
            return 0;
//            debug($this->db->last_query());
        }
    }

    public function cupon($cuenta) {
        if ($this->user->conect) {
            if ($this->user->information->pktweet > 0) {
                $today = date('Y-m-d');

                $date = $this->modelo_universal->select('cuentas', 'fecha_f', array('id_cuenta' => $cuenta, 'fecha_f !=' => '0000-00-00', 'fecha_f >' => $today));
                if ($date) {
                    $nuevafecha = strtotime('+31 day', strtotime($date[0]['fecha_f']));
                    $nuevafecha = date('Y-m-d', $nuevafecha);
                    $date = $this->modelo_universal->update('cuentas', array('fecha_f' => $nuevafecha), array('id_cuenta' => $cuenta));
                } else {
                    $today = date('Y-m-d');
                    $nuevafecha = strtotime('+31 day', strtotime($today));
                    $nuevafecha = date('Y-m-d', $nuevafecha);
                    $date = $this->modelo_universal->update('cuentas', array('fecha_f' => $nuevafecha), array('id_cuenta' => $cuenta));
                }
//            debug($this->db->last_query());
                $this->db = $this->load->database('account', true);
                $cupon = $this->user->information->pktweet - 1;
                $this->modelo_universal->update('user', array('pktweet' => $cupon), array('id' => $this->user->information->id));
                echo "si";
            } else {
                echo "no";
            }
        }
    }

    public function PayPal_IPN() {
//        $post = json_encode($_POST);
//        $post = file_get_contents('php://input');
        if ($_POST) {
// Obtenemos los datos en formato variable1=valor1&variable2=valor2&...
            $raw_post_data = file_get_contents('php://input');

// Los separamos en un array
            $raw_post_array = explode('&', $raw_post_data);

// Separamos cada uno en un array de variable y valor
            $myPost = array();
            foreach ($raw_post_array as $keyval) {
                $keyval = explode("=", $keyval);
                if (count($keyval) == 2)
                    $myPost[$keyval[0]] = urldecode($keyval[1]);
                $this->modelo_universal->insert('prueba', array('array' => urldecode($keyval[1])));
            }
        }
//        $post = $this->input->post('payer_email');
//        $get = $_GET;
//        debug($_POST, false);
//        $postdb = implode(",", $post);
//        $this->modelo_universal->insert('prueba', array('array' => $get));
//        debug($_GET);
    }

}
?>
