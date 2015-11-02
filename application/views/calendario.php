<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".nunca").click(function() {
                document.getElementById('finaliza_el').disabled = true;
//                $("#finaliza_el").val('');
                document.getElementById('tantas').disabled = true;
//                $("#tantas").val('');
            });
            $(".finaliza_en").click(function() {
                document.getElementById('finaliza_el').disabled = false;
                document.getElementById('tantas').disabled = true;
//                $("#tantas").val('');
            });
            $(".despues_De").click(function() {
                document.getElementById('tantas').disabled = false;
                document.getElementById('finaliza_el').disabled = true;
//                $("#finaliza_el").val('');
            });
        });
        function desplegable() {
//            console.log('aqui ');
            var categoria;
            categoria = document.getElementById('repite').value;
            $('.repetir_cada').css("display", "none")
            $('.repetir_el').css("display", "none")
            $('.empieza_el').css("display", "none")
            $('.finaliza').css("display", "none")
            $(".check").prop("checked", "");

//            console.log(categoria);
            switch (categoria)
            {
                case '0':
//                    console.log(categoria);
                    $('.repetir_cada').css("display", "block")
                    $('.repetir_el').css("display", "none")
                    $('.empieza_el').css("display", "block")
                    $('.finaliza').css("display", "block")
                    $('.cada').html(" dias")
                    $(".check").prop("checked", "");
                    break;
                case '1':
//                    console.log(categoria);
                    $('.repetir_cada').css("display", "none")
                    $('.repetir_el').css("display", "none")
                    $('.empieza_el').css("display", "block")
                    $('.finaliza').css("display", "block")
                    $('.cada').html("")
                    $(".check").prop("checked", "");
                    $("#MO").prop("checked", "checked");
                    $("#TU").prop("checked", "checked");
                    $("#WE").prop("checked", "checked");
                    $("#TH").prop("checked", "checked");
                    $("#FR").prop("checked", "checked");


                    break;
                case '2':
//                    console.log(categoria);
                    $('.repetir_cada').css("display", "none")
                    $('.repetir_el').css("display", "none")
                    $('.empieza_el').css("display", "block")
                    $('.finaliza').css("display", "block")
                    $('.cada').html("")
                    $(".check").prop("checked", "");
                    $("#MO").prop("checked", "checked");
                    $("#WE").prop("checked", "checked");
                    $("#FR").prop("checked", "checked");
                    break;
                case '3':
//                    console.log(categoria);
                    $('.repetir_cada').css("display", "none")
                    $('.repetir_el').css("display", "none")
                    $('.empieza_el').css("display", "block")
                    $('.finaliza').css("display", "block")
                    $('.cada').html("")
                    $(".check").prop("checked", "");
                    $("#TU").prop("checked", "checked");
                    $("#TH").prop("checked", "checked");
                    break;
                case '4':
//                    console.log(categoria);
                    $('.repetir_cada').css("display", "block")
                    $('.repetir_el').css("display", "block")
                    $('.empieza_el').css("display", "block")
                    $('.finaliza').css("display", "block")
                    $('.cada').html(" semana")
                    $(".check").prop("checked", "");
                    break;
                case '5':
//                    console.log(categoria);
                    $('.repetir_cada').css("display", "block")
                    $('.repetir_el').css("display", "none")
                    $('.empieza_el').css("display", "block")
                    $('.finaliza').css("display", "block")
                    $('.cada').html(" meses")
                    $(".check").prop("checked", "");
                    break;
                case '6':
//                    console.log(categoria);
                    $('.repetir_cada').css("display", "block")
                    $('.repetir_el').css("display", "none")
                    $('.empieza_el').css("display", "block")
                    $('.finaliza').css("display", "block")
                    $('.cada').html(" años")
                    $(".check").prop("checked", "");
                    break;
            }
            resumen();
        }

        function resumen() {
            var check = new Array();
            var repite = $("#repite").val();
            var repite2 = $("#repite").val();
            if (repite) {
                var cantidad = $("#cantidad").val();
                switch (repite)
                {
                    case '0':
                        if (cantidad && (cantidad != 1)) {
                            repite = "Cada " + cantidad + " Días";
                        } else {
                            repite = "Cada Día";
                        }
                        break;
                    case '1':
                        repite = "De lunes a viernes";
                        break;
                    case '2':
                        repite = "Los lunes, miercoles y viernes";
                        break;
                    case '3':
                        repite = "Dias martes y jueves";
                        break;
                    case '4':
                        if (cantidad && (cantidad != 1)) {
                            repite = "Cada " + cantidad + " semanas";
                        } else {
                            repite = "Cada semana";
                        }
                        break;
                    case '5':
                        if (cantidad && (cantidad != 1)) {
                            repite = "Cada " + cantidad + " meses";
                        } else {
                            repite = "Cada mes";
                        }
                        break;
                    case '6':
                        if (cantidad && (cantidad != 1)) {
                            repite = "Cada " + cantidad + " años";
                        } else {
                            repite = "Cada año";
                        }
                        break;

                }
                check.push(repite);
            }
            var empieza = $("#empieza_eldia").val();
            if (empieza) {
                check.push(' desde el ' + empieza);
            }
//            console.log($("#repite").val());
            if (($("#repite").val() < 1) || ($("#repite").val() > 3)){ 
            $(".check:checked").each(function() {
                check.push($(this).val());
            });
            }
            $(".despues_De:checked").each(function() {
                var tantas = $('#tantas').val();
                check.push(' Después de ' + tantas + ' repeticiones');
            });
            $(".finaliza_en:checked").each(function() {
                var fechfinal = $('#finaliza_el').val();
                check.push(' hasta el ' + fechfinal);
            });
            $('.content_resumen').html("<ww>" + check + "</ww>");
        }
    </script>
</head>
<body>
    <form method="Post" name="calendario">
        <div class="se_repite">
            <strong>Se Repite: </strong>
            <select id="repite" onchange="desplegable();
            return false" name="repite">
                <option value="0" title="Cada día">Cada día</option>
                <option value="1" title="Todos los días laborables (de lunes a viernes)">Todos los días laborables (de lunes a viernes)</option>
                <option value="2" title="Todos los lunes, miércoles y viernes">Todos los lunes, miércoles y viernes</option>
                <option value="3" title="Todos los martes y jueves">Todos los martes y jueves</option>
                <option value="4" title="cada semana" selected="true">cada semana</option>
                <option value="5" title="Cada mes">Cada mes</option>
                <option value="6" title="Cada año">Cada año</option>
            </select>
        </div>
        <div class="content_calendario" onchange="resumen()" >
            <div class="repetir_cada">
                <strong> Repetir Cada: </strong>
                <select id='cantidad' title="Repetir cada 1 semanas">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                </select>
                <strong class="cada"> semanas</strong>
            </div>
            <div class="repetir_el">
                <strong>Repetir El: </strong>
                <input id="MO" name="MO" class="check" value="lunes" type="checkbox" aria-label="Repita el procedimiento en lunes" title="lunes">
                <label for=":3c.dow1" title="lunes">L</label>
                <input id="TU" name="TU" class="check" value=" martes" type="checkbox" aria-label="Repita el procedimiento en martes" title="martes">
                <label for=":3c.dow2" title="martes">M</label>
                <input id="WE" name="WE" class="check" value=" miercoles" type="checkbox" aria-label="Repita el procedimiento en miércoles" title="miércoles">
                <label for=":3c.dow3" title="miércoles">X</label>
                <input id="TH" name="TH" class="check" value=" jueves" type="checkbox" aria-label="Repita el procedimiento en jueves" title="jueves">
                <label for=":3c.dow4" title="jueves">J</label>
                <input id="FR" name="FR" class="check" value=" viernes" type="checkbox" aria-label="Repita el procedimiento en viernes" title="viernes">
                <label for=":3c.dow5" title="viernes">V</label>
                <input id="SA" name="SA" class="check" value=" sabado" type="checkbox" aria-label="Repita el procedimiento en sábado" title="sábado">
                <label for=":3c.dow6" title="sábado">S</label>
                <input id="SU" name="SU" class="check" value=" domingo" type="checkbox" aria-label="Repita el procedimiento en domingo" title="domingo">
                <label for=":3c.dow0" title="domingo">D</label> 
            </div>
            <div class="empieza_el">
                <strong>Empieza El: </strong>
                <input type="date" id="empieza_eldia" value="<? echo $time = date('Y') . "-" . date('m') . "-" . date('d'); ?>" />
            </div>
            <div class="finaliza">
                <strong>Finaliza: </strong>
                <input id="3c1" name="endson" class="nunca" type="radio" aria-label="Nunca termina" checked="" title="Nunca termina">
                <label for=":3c.endson_never" title="Nunca termina">Nunca</label>
                <input id="3c2" name="endson" class="despues_De" type="radio" aria-label="Finaliza después de un número de ocurrencias" title="Finaliza después de un número de ocurrencias">
                <label for=":3c.endson_count" title="Finaliza después de un número de ocurrencias">Después de <input type="number" id="tantas" size="3" value="5" disabled="true" title="Resultados"> repeticiones</label>
                <input id="3c3" name="endson" class="finaliza_en" type="radio" aria-label="Finaliza en una fecha especificada" title="Finaliza en una fecha especificada">
                <label for=":3c.endson_until" title="Finaliza en una fecha especificada">El <input type="date" value="<? echo $time = date('Y') . "-" . date('m') . "-" . (date('d') + 5); ?>" id="finaliza_el" disabled="true"></label>
            </div>
            <div class="resumen">
                <strong>Resumen: </strong>
                <ss class="content_resumen">
                    Cada semana, desde el <? echo $time = date('Y') . "-" . date('m') . "-" . date('d'); ?>
                </ss>
            </div>
        </div>
    </form>
    
</body>