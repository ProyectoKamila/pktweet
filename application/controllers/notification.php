<?php

class Notification extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
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
    public function pr(){
    
    echo date();
    sleep(90);
    echo '<br>';
    echo date("Y-m-d");
    
    header('Content-Type: text/html; charset=UTF-8');
        ini_set('display_errors', 1);
        $this->conection();
        //aqui lo de llamar las cuenta sy enviar un solo tweet por cuenta
        $idcuenta = $this->data['idcuenta'] = $select = $this->modelo_universal->select('cuentas', '*');
        //debug($idcuenta);
    
    }
    
    public function index(){
    
    if (!isset($_GET['pass']) || $_GET['pass'] != 'hackemate') {
            exit();
        }
        
        header('Content-Type: text/html; charset=UTF-8');
        ini_set('display_errors', 1);
        $this->conection();
        //aqui lo de llamar las cuenta sy enviar un solo tweet por cuenta
        $r = $this->modelo_universal->select('cuentas', 'count(*)');
        $idcuenta = $this->data['idcuenta'] = $select = $this->modelo_universal->select('cuentas', 'id_cuenta, oauth_token_secret, oauth_token');
        //debug($r[0]['count(*)']);
        //debug($idcuenta[0]['oauth_token']);
        $i = $r[0]['count(*)'];
    //for($cont = 0; $cont < $i; $cont++){
    for($cont = 0; $cont < $i; $cont++){
    //141013510
    if($idcuenta[$cont]['id_cuenta']=141013510){
    for ($cont1 =  0; $cont1 <1440; $cont1++){
    	$tokensecret = $idcuenta[$cont]['oauth_token_secret'];
    	$token = $idcuenta[$cont]['oauth_token'];
            $settings = array(
                    'oauth_access_token' => "$token",
                    'oauth_access_token_secret' => "$tokensecret",
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
    if($cont1 == 1){
    $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $token, $tokensecret);

                $url = 'https://api.twitter.com/1.1/followers/ids.json?count=1440';
                $results = $twitteroauth->get($url);
                
    echo $cont.'- '.$idcuenta[$cont]['id_cuenta'].'('.$cont1.')<br>';
    
    }
    
    
    }
    }
    
        //sleep(60);
    //foreach ($idcuenta as $datos) {
    
            /*
            $tokensecret = $idcuenta[$cont]['oauth_token_secret'];
            $token = $idcuenta[$cont]['oauth_token'];
            
            $settings = array(
                    'oauth_access_token' => "$token",
                    'oauth_access_token_secret' => "$tokensecret",
                    'consumer_key' => CONSUMER_KEY,
                    'consumer_secret' => CONSUMER_SECRET
                );
                $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $token, $tokensecret);

                $url = 'https://api.twitter.com/1.1/followers/ids.json?count=1440';
                $results = $twitteroauth->get($url);

                
            
            if(isset($results->ids[0])){
            echo $idcuenta[$cont]['id_cuenta'].'('.$cont.')<br>';
            $r[0]['count(*)']=$r[0]['count(*)']+1;
            }else{$cont=$i;}
              */ 
            
       //     }//fin foreach
            }//fin for
    }
    }
    
    
    
    
    