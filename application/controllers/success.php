<?php

session_start();

class success extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('modelo_universal');
    }

//    public function index() {
//        echo "success";
//        $select = $this->modelo_universal->query('SELECT array FROM prueba WHERE id=7');
//        $select = $select[0]['array'];
//        $decode = $this->decodeIPN($select);
////        debug($select, false);
////        debug($decode, false);
//        $select = $this->modelo_universal->query('SELECT array FROM prueba WHERE id=8');
//        $select2 = $select[0]['array'];
//        debug($select2, false);
//        $select2 = json_decode($select2);
//        debug($select2->custom, false);
//
////        debug($select2);
//        $this->db = $this->load->database('account', true);
//        $user = $this->modelo_universal->query('SELECT user.id, user.pktweet FROM user, session WHERE user.id=session.user AND session.ip="' . $select2->custom . '"');
//        $user = $user[0];
//        debug($user);
//    }

    private function decodeIPN($string) {
        $array = explode('&', $string);
        $return = array();
        foreach ($array as $variable) {
            $variable = explode("=", $variable);
            if (count($variable) == 2)
                $return[$variable[0]] = urldecode($variable[1]);
        }
        return $return;
    }

    public function PayPal_IPN() {

        if ($_POST) {
            // Obtenemos los datos en formato variable1=valor1&variable2=valor2&...
            $raw_post_data = file_get_contents('php://input');
            $this->modelo_universal->insert('prueba', array('array' => $raw_post_data));
            $h = $this->decodeIPN($raw_post_data);
            if ($h['payment_status'] == 'Completed') {
                $ss = $this->verificar($h);
                if (strcmp($ss, "VERIFIED") == 0) {
                    $tokken = $h['custom'];
                    $this->db = $this->load->database('account', true);
                    $user = $this->modelo_universal->query('SELECT user.id, user.pktweet FROM user, session WHERE user.id=session.user AND session.ip="' . $tokken . '"');
                    $user = $user[0];
                    $compra = (int) $h['mc_gross'];
                    $cant=$compra/5;
                        $cupon = $user['pktweet'] + $cant;
                        $this->modelo_universal->update('user', array('pktweet' => $cupon), array('id' => $user['id']));
                } else {
                    
                }
            }
        }
    }

    private function verificar($myPost) {
        $req = 'cmd=_notify-validate';
        if (function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            // Cada valor se trata con urlencode para poder pasarlo por GET
            if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }

            //Añadimos cada variable y cada valor
            $req .= "&$key=$value";
        }
//        $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');   // Esta URL debe variar dependiendo si usamos SandBox o no. Si lo usamos, se queda así.
        $ch = curl_init('https://www.paypal.com/cgi-bin/webscr');         // Si no usamos SandBox, debemos usar esta otra linea en su lugar.
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

//        if (!($res = curl_exec($ch))) {
        // Ooops, error. Deberiamos guardarlo en algún log o base de datos para examinarlo después.
        $respuesta = curl_exec($ch);
        if ($respuesta) {
            return $respuesta;
        }
        $error = curl_error($ch);
        if ($error) {
            return $error;
        }
//        exit;
//        }
        curl_close($ch);
    }

}

?>
