<?$texto=$this->data['editar'][0]['texto'];
$id=$this->data['id'];
        ?>
<? $r = strlen($texto); 
$r1=140-$r;

?>
<div>
        <form method="post" name="tweet1" id="tweet1">
            <textarea cols="30" rows="5" class="twit1" name="twit1" required="" onKeyDown="valida_longitud1();" onKeyUp="valida_longitud1();" onKeyPress="valida_longitud1();" ><?=$texto?></textarea><br>
            <input type="text" id="caracteres1" size="3" value="<?=$r1?>" readonly></input>
            <input type="hidden" name="idusert" id="idusert" value="<?=$id?>" />
            <input  type="button" name="guardarg1" class="guardarg1" id="guardarg1" value="Agregar a la lista" onClick="editguard();"></input>
        </form>
    </div>
</div>