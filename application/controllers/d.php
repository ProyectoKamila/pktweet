<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class D extends CI_Controller {

    public $data = null;
    public $usuario = null;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'html'));
        $this->load->model('modelo_universal');
//        $this->session();
    }

    public function index() {
//        echo "Eeeeeeeee";
        $d = $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
//        debug($d);
        $this->data['count'] = $this->modelo_universal->select('cuentas', 'count(*)');
        $this->load->view('account/index', $this->data);
        $this->db->close();
    }

}

//SELECT count( * ) 
//FROM `clientes` 
//WHERE 1 


