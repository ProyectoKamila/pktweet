<?php

$link = mysql_connect(
        "localhost"
        , "pktweet"
        , "Pr4y2ct4"
);
mysql_select_db(
                "pktweet"
                , $link
        ) OR DIE(
                "Error: No es posible establecer la conexión"
);
echo "aqui";
if ($_POST) {
    // Obtenemos los datos en formato variable1=valor1&variable2=valor2&...
    $raw_post_data = file_get_contents('php://input');

    // Los separamos en un array
    $raw_post_array = explode('&', $raw_post_data);

    // Separamos cada uno en un array de variable y valor
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
        $sql = "INSERT INTO prueba (array) VALUES ('" . $keyval . "')";
        $result = mysql_query($sql);
//        $keyval = explode("=", $keyval);
//        if (count($keyval) == 2)
//            $myPost[$keyval[0]] = urldecode($keyval[1]);
//        $this->modelo_universal->insert('prueba', array('array' => ));
    }
}
?>
