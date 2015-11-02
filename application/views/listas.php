<div><? // $cuentas = $this->data['cuentas']; ?><?
//
//if (isset($cuentas)) {
//    foreach ($cuentas as $c) {
//        $id = $c['id_cuenta'];
//        $nombre = $c['screen_name'];
////        echo " <a href='./listas?idcuenta=".$id."'>" . $nombre . "</a><br>";
//        echo " <a href='javascript:cta(".$id.")'>" . $nombre . "</a><br>";
//    }
//}
?></div>
    <form method="post" >
        <input type="hidden" name="id_cuenta" value="3" id="user" />
        <input type="hidden" name="id_user" value="1" id="user" />
        <select name="intervalo" id="intervalo" required>
            <option value="5">5 min. </option>
            <option value="10">10 min. </option>
            <option value="15">15 min. </option>
            <option value="20">20 min. </option>
        </select>
        <!--<input class="button" type="submit" name="cargar" value="Crear Lista Ciclica"  onclick = "this.form.action = './controller/crear_lista';" ></input><br>-->
    </form>
    <div id="tweet" class="tweet">
        
        <form method="post" name="tweet" action="./controller/cyclic" id="tweet">
            <textarea cols="30" rows="5" class="twit" name="twit" required onKeyDown="valida_longitud();" onKeyUp="valida_longitud();" onKeyPress="valida_longitud();" ></textarea><br>
            <input type="text" name="caracteres" id="caracteres" size="3" value="140" readonly></input>
            <input  type="button" name="guardarg" class="guardarg" id="guardarg" value="Agregar a la lista" onClick="algo();"></input>
        </form>
    </div>
    <div class="pktweet" id="pktweet"><? $this->load->view('tweets'); ?></div>
    <div id="editweet" class="modalDialog">
        <div >
            <a href="controller/lista_ciclica#close" title="Close" class="close">X</a>
            <div class="contenidomodal" id="contenidomodal" style="width: auto; height: auto; max-height: 100%; max-width: 100%;">
            </div>
        </div>
    </div>
