<?php

class Restaurar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
    }

    public function index() {
        if (!isset($_GET['pass']) || $_GET['pass'] != 'hackemate') {
            exit();
        }
        $todays_date = date("Y-m-d");
        $this->modelo_universal->update('cuentas', array('tweets' => 96, 'seguidores' => 150, 'fans' => 100, 'cpseguidores' => 100,'retweet' => 50), array('fecha_f <' => $todays_date));
        $this->modelo_universal->update('cuentas', array('tweets' => 2000, 'seguidores' => 150, 'fans' => 100, 'cpseguidores' => 100,'retweet' => 2000), array('fecha_f >=' => $todays_date));

        $this->db = $this->load->database('account',true);
        $this->modelo_universal->update('session', array('flag' => 0), array('flag'=>1));
    }

}

?>