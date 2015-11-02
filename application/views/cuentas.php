<? $cuentas = $this->data['ctas']; ?>
<?
if (isset($cuentas)) {
    foreach ($cuentas as $c) {
//debug($c);
        $id = $c['id_cuenta'];
        $nombre = $c['screen_name'];
//        echo " <a href='./lista_ciclica?idcuenta=".$id."'>" . $nombre . "</a><br>";
        echo " <a href='./lista_ciclica/".$id."'>" . $nombre . "</a><br>";
        
//        echo " <a href='javascript:cta(".$id.")'>" . $nombre . "</a><br>";
    }
}
?>