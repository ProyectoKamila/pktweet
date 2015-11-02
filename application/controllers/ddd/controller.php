<?php

class Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'html'));
        $this->load->model('modelo_universal');
        $this->session();
//        if (!$this->user->conect) {
//            $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
//                    $this->load->view('inicio',  $this->data);
//            redirect('http://account.proyectokamila.com/p/?url=7');
//        }
//        $this->data['post'] = $this->input->post();
    }

    public function index($id_t = null) {
        if($id_t != 'null'){
//        settype($id_t, 'int');
//        debug($id_t);
            $id_cuenta=$id_t;
        }
        if (!$this->user->conect) {
            $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
            $this->load->view('header');
            $this->load->view('inicio', $this->data);
        } else {
            $idaccount = $this->user->information->id;
//        session_start();
//        $this->session->set_userdata('')
//        var_dump($_SESSION, false);
            if (isset($_GET["reset"])) {
                if ($_GET["reset"] == 1) {
//                session_destroy();
                    header('Location: ./controller');
                }
            }
            $this->data['resultado'] = $this->modelo_universal->select('cuentas', '*', array('id_account' => $idaccount));
            $resultado = $this->data['resultado'];
            if ($resultado != NULL) {
                $_SESSION['iden'] = $iden = $this->user->information->id . "0";
                $this->data['screenname'] = $screenname = $_SESSION['request_vars']['screen_name'] = $resultado[0]['screen_name'];
                $this->data['twitterid'] = $twitterid = $_SESSION['request_vars']['user_id'] = $resultado[0]['user_id'];
                $this->data['oauth_token'] = $oauth_token = $_SESSION['request_vars']['oauth_token'] = $resultado[0]['oauth_token'];
                $this->data['oauth_token_secret'] = $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'] = $resultado[0]['oauth_token_secret'];
                $this->conection();
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
//                debug($resultado);
                $this->data['resultado'] = $resultado;
                $this->lista_ciclica($this->data['resultado'][0]['id_cuenta']);
//                $this->cuentas();debug($this->data['resultado'][0]['id_cuenta']);
//                debug($this->data['cuentas']);
                $this->data['cuentas'] = $this->modelo_universal->select('cuentas', 'count(*)', array('id_account' => $idaccount));
                $this->load->view('header', $this->data['resultado'], $this->data['cuentas']);
                $this->load->view('index', $this->data);
//                $this->load->view('pktweet/header', $this->data['resultado']);
//                $this->load->view('pktweet/index', $this->data);
//                $this->load->view('pktweet/footer');
            } else {
                $this->conection();
            $this->conection();
//            debug($_SESSION);
                if (isset($_SESSION['status']) && $_SESSION['status'] == 'verified') { //Success, redirected back from process.php with varified status.
                    //retrive variables
//                    debug($_SESSION, false);
//                    debug("eeee");
                    $name = $this->user->information->name;
                    $s = explode(' ', $name);
                    $namel = $this->user->information->last_name;
                    $sl = explode(' ', $namel);
                    $name_c = $s[0] . " " . $s[1][0] . " " . $sl[0] . " " . $sl[1][0];
                    $this->data['screenname'] = $screenname = $_SESSION['request_vars']['screen_name'];
                    $this->data['twitterid'] = $twitterid = $_SESSION['request_vars']['user_id'];
                    $this->data['oauth_token'] = $oauth_token = $_SESSION['request_vars']['oauth_token'];
                    $this->data['oauth_token_secret'] = $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
                    settype($idaccount, 'string');
                    
                    setcookie("oauth_token", $this->data['oauth_token'], 0, '/');
                    setcookie("oauth_token_secret", $this->data['oauth_token_secret'], 0, '/'); 
                    
                    $contador = $this->modelo_universal->select('cuentas', 'count(*)', array('id_account' => $idaccount)); // cuanta la cantidad de de tweets
//                    debug($contador[0]['count(*)']);
                    $contador = $contador[0]['count(*)'];
                    settype($contador, 'String');
                    $_SESSION['iden'] = $iden = $idaccount . $contador;

//                    debug($iden);
                    settype($idaccount, 'int');
                    settype($contador, 'int');
                    //colocar aqui la validacion si existe o no la cuenta
                    $nombre=$this->modelo_universal->select('cuentas', 'screen_name', array('id_account' => $idaccount, 'screen_name'=>$screenname));
//                    debug($nombre);
                    if($nombre[0]['screen_name']==NULL){
                    $query = $this->db->query("INSERT INTO cuentas (id_cuenta, oauth_token,oauth_token_secret,user_id, screen_name, nombre, id_account) VALUES ('$iden','$oauth_token','$oauth_token_secret','$twitterid','$screenname','$name_c','$idaccount')");
                    $query=$this->db->query("UPDATE  `tweet` SET  `id_user` =".$idaccount." WHERE  `id_cuenta` =".$twitterid);
                    $query = $this->db->query("INSERT INTO lista_ciclica (id_ciclica, id_cuenta,intervalo) VALUES ('$iden','$iden','10')");
                    }
                  
                    
                    
                    
//                    $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
//                    $this->load->view('authorize',  $this->data);
                    $this->data['ctas'] = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name', array('id_account' => $idaccount));

                    $this->data['resultado'] = $resultado;

                    $this->data['cuentas'] = $this->modelo_universal->select('cuentas', 'count(*)', array('id_account' => $idaccount));
                    $this->lista_ciclica($this->data['resultado'][0]['id_cuenta']);
                    $this->cuentas();
                    
                    $this->load->view('header', $this->data['resultado'], $this->data['cuentas']);
                    $this->load->view('index', $this->data);
//                    $this->data['cuentas'] = $this->modelo_universal->select('cuentas', 'count(*)', array('id_account' => $idaccount));
//                    $this->load->view('header', $this->data['resultado'], $this->data['cuentas']);
//                    $this->load->view('index', $this->data);
//                    $this->load->view('pktweet/header', $this->data['resultado']);
//                    $this->load->view('pktweet/index', $this->data);
//                    $this->load->view('pktweet/footer');
                }
            $this->data['resultado'] = $this->modelo_universal->select('cuentas', '*', array('id_account' => $idaccount));
            $resultado = $this->data['resultado'];
            if ($resultado != NULL) {
                $_SESSION['iden'] = $iden = $this->user->information->id . "0";
                $this->data['screenname'] = $screenname = $_SESSION['request_vars']['screen_name'] = $resultado[0]['screen_name'];
                $this->data['twitterid'] = $twitterid = $_SESSION['request_vars']['user_id'] = $resultado[0]['user_id'];
                $this->data['oauth_token'] = $oauth_token = $_SESSION['request_vars']['oauth_token'] = $resultado[0]['oauth_token'];
                $this->data['oauth_token_secret'] = $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'] = $resultado[0]['oauth_token_secret'];
                
                setcookie("oauth_token", $this->data['oauth_token'], 0, '/'); 
                setcookie("oauth_token_secret", $this->data['oauth_token_secret'], 0, '/'); 
                
                $this->data['verificar']=$this->modelo_universal->select('cuentas', 'count(id_cuenta)', array('id_account' => $idaccount, 'screen_name'=>$screenname));
                $verificar=$this->data['verificar'];
//                 debug($verificar[0]['count(id_cuenta)']);
//                if($verificar[0]['count(id_cuenta)']=='1'){
//                           $name = $this->user->information->name;
//                    $s = explode(' ', $name);
//                    $namel = $this->user->information->last_name;
//                    $sl = explode(' ', $namel);
//                    $name_c = $s[0] . " " . $s[1][0] . " " . $sl[0] . " " . $sl[1][0];
//                    $contador = $this->modelo_universal->select('cuentas', 'count(*)', array('id_account' => $idaccount)); // cuanta la cantidad de de tweets
//                    $contador = $contador[0]['count(*)'];
//                    settype($contador, 'String');
//                    $_SESSION['iden'] = $iden = $idaccount . $contador;
//                    settype($idaccount, 'int');settype($contador, 'int');
//                 $query = $this->db->query("INSERT INTO cuentas (id_cuenta, oauth_token,oauth_token_secret,user_id, screen_name, nombre, id_account) VALUES ('$iden','$oauth_token','$oauth_token_secret','$twitterid','$screenname','$name_c','$idaccount')");
//                 $query = $this->db->query("INSERT INTO lista_ciclica (id_ciclica, id_cuenta,intervalo) VALUES ('$iden','$iden','10')");   
//                }
                
                
//                $this->conection();
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
//                debug($resultado);
                $this->data['resultado'] = $resultado;
                $this->lista_ciclica($this->data['resultado'][0]['id_cuenta']);
                $this->data['cuentas'] = $this->modelo_universal->select('cuentas', 'count(*)', array('id_account' => $idaccount));
                $this->data['ctas'] = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name', array('id_account' => $idaccount));
                $this->load->view('header', $this->data['resultado'], $this->data['cuentas']);
                $this->load->view('index', $this->data);
//                $this->load->view('pktweet/header', $this->data['resultado']);
//                $this->load->view('pktweet/index', $this->data);
//                $this->load->view('pktweet/footer');
            } else {
                 
                    $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
                    $this->load->view('header');
                    $this->load->view('authorize', $this->data);
                }
        }
    }}

    public function cuentas() {
        $idaccount = $this->user->information->id;
        $this->data['cuentas_t'] = $this->modelo_universal->select('cuentas', 'id_cuenta,screen_name', array('id_account' => $idaccount));
//        $this->data['tweet'] = $this->modelo_universal->select('tweet', '*', array('tweet.id_cuenta' => $this->data['r'][0]['id_cuenta'], 'id_user' => $idaccount));
//        $this->load->view('cuentas', $this->data); //carga la vista
    }

    public function autorizar() {
        $this->load->view('header');
        $this->load->view('authorize'); //carga la vista
    }

    public function pr() {
        $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');


        debug("aqui");
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
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $results = $twitteroauth->post($url, array(
            'status' => 'Haciendo pruebas de tweet automaticos en el nuevo kapptweet de @Proyectokmila #UnaVidaPk',
            'display_coordinates' => 'false'
        ));
    }
    
    private function l(){
        
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
//        $this->data['tweet'] = $select = $this->modelo_universal->select('tweet', '*', array('id_cuenta' => 1, 'id_lista' => 1, 'id_user' => 1)); //selecciona los tweets
//        $this->load->view('listas', $this->data); //carga la vista
        $hab = $this->modelo_universal->select('tweet', 'id_twett,habilitar', array('id_twett' => $id));
//debug($hab);
        if ($hab[0]['habilitar'] === '1') {
            echo '<a href="javascript:habilitar(' . $hab[0]['id_twett'] . ',' . $hab[0]['habilitar'] . ')"class="icon icon-x"></a>';
        } else {
            echo '<a href="javascript:habilitar(' . $hab[0]['id_twett'] . ',' . $hab[0]['habilitar'] . ')"class="icon icon-check"></a>';
        }
    }

    public function cyclic() {
        $iden = $_SESSION['iden'];
        $idaccount = $this->user->information->id;
        $texto = $this->input->post('twit'); //texto contenido en el tweet

        $contador = $this->modelo_universal->select('tweet', 'count(id_twett)', array('id_cuenta' => $idaccount, 'id_lista' => $iden, 'id_user' => $idaccount));
        $cont = $contador[0]['count(id_twett)'];
        settype($cont, 'int');
        $cont = $cont + 1;

//<<<<<<< .mine
        $this->modelo_universal->insert('tweet', array('id_twett' => 0, 'texto' => $texto, 'id_cuenta' => $iden, 'id_user' => $idaccount, 'id_lista' => $iden, 'posicion' => $cont, 'estatus' => 0, 'habilitar' => 1));
        $this->data['tweet'] = $select = $this->modelo_universal->select('tweet', 'texto,posicion', array('id_cuenta' => $iden, 'id_lista' => $iden, 'id_user' => $idaccount), null, null, 'posicion', 'DESC');
///=======
        $this->modelo_universal->insert('tweet', array('id_twett' => 0, 'texto' => $texto, 'id_cuenta' => $iden, 'id_user' => $idaccount, 'id_lista' => $iden, 'posicion' => $cont, 'estatus' => 0, 'habilitar' => 1));
        $this->data['tweet'] = $select = $this->modelo_universal->select('tweet', '*', array('id_cuenta' => $iden, 'id_lista' => $iden, 'id_user' => $idaccount), null, null, 'posicion', 'DESC');
///>>>>>>> .r36

        $this->load->view('listas', $this->data); //se carga la vista con todos los datos recogidos
    }

    public function eliminart() {
        $id = $this->input->post('id'); //texto contenido en el tweet
        settype($id, 'int'); //convierte en entero el ind que ingresa siendo string

        $identificadores = $this->modelo_universal->select('tweet', 'id_cuenta,id_user,id_lista', array('id_twett' => $id)); //obtiene usando el id del tweet los demas id

        $cuenta = $identificadores[0]['id_cuenta']; //agrega en una variable el id de la cuenta
        $lista = $identificadores[0]['id_lista']; //agrega en una variable el id de la lista
        $user = $identificadores[0]['id_user']; // agrega en una variable el id del usuario

        $this->modelo_universal->delete('tweet', array('id_twett' => $id)); //elimina el tweet
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

    public function guardartweet() {
        if ($this->input->post()) {
            $texto = $this->input->post('twit1'); //texto contenido en el tweet
            $idusert = $this->input->post('idusert'); //texto contenido en el tweet
            $true = $this->modelo_universal->update('tweet', array('texto' => $texto), array('id_twett' => $idusert));
        }
    }

    public function lista_ciclica($id) {
//<<<<<<< .mine
        $idaccount = $this->user->information->id;
        $this->data['tweet'] = $this->modelo_universal->select('tweet', '*', array('tweet.id_cuenta' => $id, 'id_user' => $idaccount));
    
//=======
         $iden = $_SESSION['iden'];
        $idaccount = $this->user->information->id;
        $this->data['tweet'] = $select = $this->modelo_universal->select('tweet', '*', array('id_cuenta' => $iden, 'id_lista' => $iden, 'id_user' => $idaccount), null, null, 'posicion', 'DESC');
    }
//>>>>>>> .r36

    public function process() {
        $this->config();
        require_once('./application/libraries/twitteroauth.php');

//            debug($_REQUEST);
        if (isset($_REQUEST['oauth_token']) && $_SESSION['token'] !== $_REQUEST['oauth_token']) {

// if token is old, distroy any session and redirect user to index.php
//	session_destroy();
            header('Location: ./controller');
        } elseif (isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

// everything looks good, request access token
//successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'], $_SESSION['token_secret']);
            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            if ($connection->http_code == '200') {
//redirect user to twitter
//<<<<<<< .mine
                $_SESSION['status'] = 'verified';
                $_SESSION['request_vars'] = $access_token;
//=======
                $_SESSION['status'] = 'verified';
                $_SESSION['request_vars'] = $access_token;
                
//>>>>>>> .r36

// unset no longer needed request tokens
                unset($_SESSION['token']);
                unset($_SESSION['token_secret']);
                header('Location: ./controller');
            } else {
                die("error, try again later!");
            }
        } else {

            if (isset($_GET["denied"])) {
                header('Location: ./controller');
                die();
            }

//fresh authentication
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
            $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

//received token info from twitter
            $_SESSION['token'] = $request_token['oauth_token'];
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
            redirect("http://127.0.0.1/pktweetsvn/controller/verify?oauth_token=jIOXKzYELWdfYgk2nXFiIHAz58GeINBvnqlVIfRb8&oauth_verifier=pacFbZNB9yXnU8Hp2jrIXMu29wJd9BdgnUQRC8EB7Ek");
        }

        $this->config();
        require_once('./application/libraries/twitteroauth.php');
        debug($_REQUEST, false);
//        debug("rrrrrrr", false);
////        debug($_REQUEST['oauth_token'],false);
//        debug($_SESSION, false);
//        debug("sessionr", false);
//        debug($_SESSION['request_vars']['oauth_token'], false);
//        debug("sessionr 1", false);
//        debug($_SESSION['request_vars']['oauth_token_secret'], false);
//        debug("sessionr 2", false);
//        redirect("http://127.0.0.1/pktweetsvn/process?oauth_token=fGbdXOViXt6KaHN5AqrXCIuK2iostgPip0tdBZDuHM&oauth_verifier=Tssxe3doO8z4OqJKbXfJ5x5wajG6JvbmbL4fP91fAkk");
//        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_REQUEST['oauth_token'], '141013510-ieBqgx45Xjqf6u6HEnZSNa8JmQNdXmqmvG9DB8kd');
//            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->getRequestToken(OAUTH_CALLBACK);


        debug($connection);
    }

    public function vr() {
        require_once('./application/libraries/twitteroauth.php');
// TwitterOAuth instance, with two new parameters we got in twitter_login.php
        $twitteroauth = new TwitterOAuth('XDfh6ZDVP9gbHwYIYG7uuZczG', '7BgUcOrNYOTsUUArQOYdu5QpfJc24DCb0so5Tp96W7nKBUtFDP', '141013510-ieBqgx45Xjqf6u6HEnZSNa8JmQNdXmqmvG9DB8kd', 'TLYLmsv51LNOBcF3EVFeoiCP2VoG4FQJuvKSEAwH41Dxr');
// Let's request the access token
        $access_token = $twitteroauth->getAccessToken('pacFbZNB9yXnU8Hp2jrIXMu29wJd9BdgnUQRC8EB7Ek');
// Save it in a session var
        $_SESSION['access_token'] = $access_token;
// Let's get the user's info
        $user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
        debug($user_info);
    }

    public function editar() {
        $id = $_GET["id"]; //obtiene por metodo get el id del tweet
        settype($id, 'int'); //convierte en entero el ind que ingresa siendo string
        $this->data['editar'] = $this->modelo_universal->select('tweet', 'texto', array('id_twett' => $id)); //cuenta la cantidad de tweet habilitados hay
        $this->data['id'] = $id;
        $this->load->view('editar', $this->data); //carga la vista
    }

    public function listas() {
        $idaccount = $this->user->information->id;

        $id = $this->data['cuentas'] = $this->modelo_universal->select('cuentas', 'id_cuenta', array('id_account' => $idaccount)); //selecciona los tweets
        $idcuenta = $id[0]['id_cuenta'];
        $this->data['tweet'] = $this->modelo_universal->select('tweet', '*', array('id_cuenta' => $idcuenta, 'id_lista' => $idcuenta, 'id_user' => $idaccount), null, null, 'posicion', 'DESC'); //selecciona los tweets
        $this->load->view('tweets', $this->data); //carga la vista
    }

    public function uri() {
        $uri = './';
        redirect($uri);
    }

    public function salir() {
        session_destroy();
        $uri = 'http://account.proyectokamila.com/p/close.php?url=7&ip=' . $_COOKIE['ip'];
        redirect($uri);
    }

    private function session() {

        $config['tokken'] = '40d89a135e0e68cc8896dd301b65352E';
        $config['tag'] = true;
        $this->load->library('user', $config);
    }

    private function config() {
        define('CONSUMER_KEY', 'XDfh6ZDVP9gbHwYIYG7uuZczG');
        define('CONSUMER_SECRET', '7BgUcOrNYOTsUUArQOYdu5QpfJc24DCb0so5Tp96W7nKBUtFDP');
        define('OAUTH_CALLBACK', 'http://127.0.0.1/pktweetsvn/process');
    }

    private function conection() {
        $this->config();
        require_once('./application/libraries/twitteroauth.php');
        require_once('./application/libraries/TwitterAPIExchange.php');
    }

}
?>

<!--https://api.twitter.com/oauth/authorize?oauth_token=fGbdXOViXt6KaHN5AqrXCIuK2iostgPip0tdBZDuHM
https://api.twitter.com/oauth/authorize.json?oauth_token=fGbdXOViXt6KaHN5AqrXCIuK2iostgPip0tdBZDuHM-->


<!--http://127.0.0.1/pktweetsvn/process?oauth_token=fGbdXOViXt6KaHN5AqrXCIuK2iostgPip0tdBZDuHM&oauth_verifier=Tssxe3doO8z4OqJKbXfJ5x5wajG6JvbmbL4fP91fAkk-->