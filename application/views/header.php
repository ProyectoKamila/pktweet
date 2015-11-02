<!DOCTYPE html>
<? ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);?>
<html>
    <head>
        <base href="<?php echo base_url(); ?>" />
        <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
        <!--<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=http://pktweet.proyectokamila.com">-->
        <meta charset="UTF-8">
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/font/styles.css" rel="stylesheet" type="text/css" />
        <link href="css/font/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="css/modal.css" rel="stylesheet" type="text/css" />
        <link href="css/services.css" rel="stylesheet" type="text/css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-55295300-1', 'auto');
            ga('send', 'pageview');

        </script>
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">-->

        <script type="text/javascript">
            $(document).ready(function() {
                $("#boton").click(function() {
                    $("#target").toggleClass("open");
                    $(".columns-content").toggleClass("topen");
                    if ($('topen')) {
                        console.log("si");
                    } else {
                        console.log("no");
                    }
//                    $("#boton").toggleClass("b");
                });
                $("#profile").click(function() {
                    console.log("rrrr");
                    $("#profile1").toggleClass("profile1");
                    $("#profile2").toggleClass("profile1");
                    $("#profile3").toggleClass("profile1");
                    $("#profile-nav1").removeClass("profile1");
                    $("#profile-nav2").removeClass("profile1");
                    $("#profile-nav3").removeClass("profile1");
                });
                $("#checknofollow").click(function() {
                    var bol = false;
                    $(".checknofollow:checked").each(function() {

                        bol = true;
                    });
                    if (!bol) {
                        console.log(false);
                        $(".checknofollow").prop("checked", "");


                    }
                    else {
                        console.log(true);
                        $(".checknofollow").prop("checked", "checked");
                    }
                });
                $("#profile-nav").click(function() {
                    console.log("rrrr");
                    $("#profile-nav1").toggleClass("profile1");
                    $("#profile-nav2").toggleClass("profile1");
                    $("#profile-nav3").toggleClass("profile1");
                    $("#profile1").removeClass("profile1");
                    $("#profile2").removeClass("profile1");
                    $("#profile3").removeClass("profile1");
                });
                $("#profile-c").click(function() {
                    $("#profile-c1").toggleClass("profile1");
                    $("#profile-c2").toggleClass("profile1");
                    $("#profile-c3").toggleClass("profile1");
                });
                $("#boton1").click(function() {
                    $("#target1").toggleClass("open");
                    $(".columns-content").toggleClass("topen");
                    $("#boton1").toggleClass("b");
                    $("#boton1").toggleClass("b1");
                });
//                $("#togg0").click(function() {
//                    $("#margin0").toggleClass("margin-open");
//                    $("#togg-article0").toggleClass("togg-article-open");
//                });
//                $("#togg1").click(function() {
//                    $("#margin1").toggleClass("margin-open");
//                    $("#togg-article1").toggleClass("togg-article-open");
//                });
            });
            function abrir() {
                $("#margin0").toggleClass("margin-open");
                $("#togg-article0").toggleClass("togg-article-open");
            }
            function abrir2() {
                $("#margin1").toggleClass("margin-open");
                $("#togg-article1").toggleClass("togg-article-open");
            }
        </script>
        <script>
//            $(document).ready(function() {
//                var clases = 'tal vaina';
//                $('#editint456').focusin(function() {
//                    console.log('clase: ' + clases);
//
//                });
//            });
            function checknofollow() {
                var bol = false;
                $(".checknofollow:checked").each(function() {

                    bol = true;
                });
                if (!bol) {
                    console.log(false);
                    $(".checknofollow").prop("checked", "checked");


                }
                else {
                    console.log(true);
                    $(".checknofollow").prop("checked", "");
                }
            }
            function checkfans() {
                var bol = false;
                $(".checkfans:checked").each(function() {

                    bol = true;
                });
                if (!bol) {
                    console.log(false);
                    $(".checkfans").prop("checked", "checked");


                }
                else {
                    console.log(true);
                    $(".checkfans").prop("checked", "");
                }
            }
            function checksearch() {
                var bol = false;
                $(".checksearch:checked").each(function() {

                    bol = true;
                });
                if (!bol) {
                    console.log(false);
                    $(".checksearch").prop("checked", "checked");


                }
                else {
                    console.log(true);
                    $(".checksearch").prop("checked", "");
                }
            }
            function eliminarfollowall(idaccount) {
                var selectedItems = new Array();
                var bol = false;
                $(".checknofollow:checked").each(function() {
                    bol = true;
//            console.log($(this).val());
                    selectedItems.push($(this).val());
                });

                var conta2 = $('#seguidores').html();
                conta2 = parseInt(conta2);
                if (conta2 > 0) {
                    $('.loadcheck').html('Espere...');
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./nofollowall/",
                        data: "idaccount=" + idaccount + "&id=" + selectedItems,
                        success: function(data) {
                            if (data == 'fallo') {
                                $('.loadcheck').html('El limite diario de dejar de seguir es menor al seleccionado por favor active una VIP ó intente mañana');
                            }
                            else {
                                $('.loadcheck').html('Se ha realizado con éxito');
                                $('#contadork').html('0');
                                $('#seguidores').html(data);
                            }
                        }
                    });
                }
                else {
                    alert('Se ha agotado el numero de dejar de seguir por día, para realizar esta acción de forma ilimitada adquiera o active un cupon mensual');
                }
            }
            function followsearch(idaccount) {
                var selectedItems = new Array();
                var bol = false;
                $(".checksearch:checked").each(function() {
                    bol = true;
//            console.log($(this).val());
                    selectedItems.push($(this).val());
                });

                var conta2 = $('#cpseguidores').html();
                conta2 = parseInt(conta2);
                if (conta2 > 0) {
                    $('.loadchecksearch').html('Espere...');
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./followusersearchall/",
                        data: "idaccount=" + idaccount + "&id=" + selectedItems,
                        success: function(data) {
                            if (data == 'fallo') {
                                $('.loadchecksearch').html('El limite diario de dejar de seguir es menor al seleccionado por favor active una VIP ó intente mañana');
                            }
                            else {
                                $('.loadchecksearch').html('Se ha realizado con éxito');
                                if (conta2 !== 999999999) {
                                    $('#cpseguidores').html(data);
                                }
                            }
                        }
                    });
                }
                else {
                    alert('Se ha agotado el numero de dejar de seguir por día, para realizar esta acción de forma ilimitada adquiera o active un cupon mensual');
                }
            }
            function seguirfans(idaccount) {
                var selectedItems = new Array();
                var bol = false;
                $(".checkfans:checked").each(function() {
                    bol = true;
//            console.log($(this).val());
                    selectedItems.push($(this).val());
                });

                var conta2 = $('#fans').html();
                conta2 = parseInt(conta2);
                if (conta2 > 0) {
                    $('.loadcheckfans').html('Espere...');
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./followuserall/",
                        data: "idaccount=" + idaccount + "&id=" + selectedItems,
                        success: function(data) {
                            if (data == 'fallo') {
                                $('.loadcheckfans').html('El limite diario de dejar de seguir es menor al seleccionado por favor active una VIP ó intente mañana');
                            }
                            else {
                                $('.loadcheckfans').html('Se ha realizado con éxito');
                                $('#contadorkuser').html('0');
                                $('#fans').html(data);
                            }
                        }
                    });
                }
                else {
                    alert('Se ha agotado el numero de dejar de seguir por día, para realizar esta acción de forma ilimitada adquiera o active un cupon mensual');
                }
            }
            function search(d) {
                var parametros = {
                    "d": d,
                    "id": '<?= $this->data['idcuentatwitter']; ?>'
                };
                $.ajax({
                    data: parametros,
                    url: 'controller/search',
                    type: 'post',
                    beforeSend: function() {
                        $("#resultado").html("Procesando, <img src='./img/spinner.gif'/>");
                    },
                    success: function(response) {
                        $("#resultado").html(response);
                    }
                });
            }

            function noseguidores(id) {

                $("#noseguidores").html("Procesando, <img src='./img/spinner.gif'/>");
                $("#noseguidores").load("./noseguidores/" + id);

            }
            function fans(id) {

                $("#fanssearch").html("Procesando, <img src='./img/spinner.gif'/>");
                $("#fanssearch").load("./fans/" + id);

            }

            function sssdasd(id) {
//                console.log('clase: numbercambio'+id);
                $('.numbercambio' + id).css('display', 'block');
                var letras = document.getElementById('editint' + id).innerHTML.length;
//                var letras = document.getElementById('numbercambio'+id).innerHTML.length;
                $('.numbercambio' + id).html((141 - letras));
                if ((140 - letras) < -1) {
                    $('.numbercambio' + id).css('color', 'red');
                    document.getElementById('savecambio' + id).href = "javascript: alert('Cantidad de Caracteres Excedido')";
                } else {
                    $('.numbercambio' + id).css('color', 'green');
                    document.getElementById('savecambio' + id).href = "javascript: editguard(" + id + ")";
                }
//                console.log(letras);
            }

            function eliminarfollow(idaccount, id) {
                var conta2 = $('#seguidores').html();
                conta2 = parseInt(conta2);
                if (conta2 > 0) {
                    var laclase = ".elimfollow" + id;
                    $(laclase).hide();
                    var laclasea = ".elimfollowa" + id;
                    $(laclasea).html('Espere...');
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./nofollow/",
                        data: "idaccount=" + idaccount + "&id=" + id,
                        success: function() {
                            var conta = $('#contadork').html();
                            conta = parseInt(conta);
                            conta = conta - 1;
                            $('#contadork').html(conta);

                            conta2 = conta2 - 1;
                            $('#seguidores').html(conta2);
                        }
                    });
                }
                else {
                    alert('Se ha agotado el numero de dejar de seguir por día, para realizar esta acción de forma ilimitada adquiera o active un cupon mensual');
                }
            }

            function followuser(idaccount, id) {
                var conta2 = $('#fans').html();
                conta2 = parseInt(conta2);
                if (conta2 > 0) {
                    var laclase = ".elimfollow" + id;
                    $(laclase).hide();
                    var laclasea = ".followuser" + id;
                    $(laclasea).html('Espere...');
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./followuser/",
                        data: "idaccount=" + idaccount + "&id=" + id,
                        success: function() {
                            var conta = $('#contadorkuser').html();
                            conta = parseInt(conta);
                            conta = conta - 1;
                            $('#contadorkuser').html(conta);
                            conta2 = conta2 - 1;
                            $('#fans').html(conta2);
                        }
                    });
                }
                else {
                    alert('Se ha agotado el numero seguir por día, para realizar esta acción de forma ilimitada adquiera o active un cupon mensual');
                }
            }


            function followusersearch(idaccount, id) {
                console.log('cambio');
                var conta2 = $('#cpseguidores').html();
                conta2 = parseInt(conta2);
                if (conta2 > 0) {
                    var laclase = ".elimfollow" + id;
                    $(laclase).hide();
                    var laclasea = ".followuser" + id;
                    $(laclasea).html('Espere...');
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./followuser/",
                        data: "idaccount=" + idaccount + "&id=" + id,
                        success: function() {
                            conta2 = conta2 - 1;
                            $('#cpseguidores').html(conta2);
                        }
                    });
                }

                else {
                    alert('Se ha agotado el numero seguir por día, para realizar esta acción de forma ilimitada adquiera o active un cupon mensual');
                }
            }

//            function search(d) {
//            var parametros = {
//            "d": d,
//                    "id":'<?= $this->data['idcuentatwitter']; ?>'
//            };
//                    $.ajax({
//            data:  parametros,
//                    url:   'controller/search',
//                    type:  'post',
//                    beforeSend: function () {
//            $("#resultado").html("Procesando, <img src='./img/spinner.gif'/>");
//            },
//                    success:  function (response) {
//            $("#resultado").html(response);
//            }
//            });
//            }

            function habilitar(id, hab) {
                var ide = "#" + id;
                $(ide).html("<img src='./img/spinner.gif'/>");
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: "./controller/habilitar",
                    data: "id=" + id + "&hab=" + hab,
                    success: function(data) {
                        $(ide).html(data);
                    }
                });
            }

            function editar(id) {
                $('.contenidomodal').html("<img src='./img/spinner.gif'/>");
                $('.contenidomodal').load('./controller/editar?id=' + id);
            }

            function eliminar(id) {
                var elim = ".elim" + id;
                var elim2 = ".elim2" + id;
                $(elim2).html("<img src='./img/spinner.gif'/>");
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: "./controller/eliminart",
                    data: "id=" + id,
                    success: function(data) {
                        $('.nwtw' + id).remove();
                        $(elim).hide();
                    }
                });
            }

            function cta(id) {
                $("#pktweet").html("Cambiando cuenta...");
                $("#pktweet").load("./controller/listas/" + id);
            }

            function editguard(id) {
                document.getElementById('editint' + id).contentEditable = false;
                var ss = '.twit' + id;
//                var twit2 = $('#editint'+ idusert).val();
                var twit1 = document.getElementById('editint' + id).innerHTML;
                var twit2 = document.getElementById('editint' + id).innerHTML.length;
                if (twit2 > 141) {
                    var res = twit1.substr(0, 140)
                    twit1 = res;
                }
                $('.numbercambio' + id).html("<img title='Guardando' src='./img/spinner.gif'/>");
//                    console.log(id);
                $('#editint' + id).html('actualizando...');
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: "./controller/guardartweet",
                    data: "idusert=" + id + "&twit1=" + twit1,
                    success: function(data) {
                        $('.savecambio' + id).css('display', 'none');
                        $('.numbercambio' + id).css('display', 'none')
                    }
                });
                $('#editint' + id).html(twit1);
//                
//                $("#pktweet").html("Actualizando...");
//                $("#pktweet").load("./controller/listas");
//                window.location.href = "./#close";

            }

            function algo() {
                var twit = $('.twit').val();
                var tweet = new Array();
                $("#tweet:checked").each(function() {
                    tweet.push($(this).val());
                });
                var num_caracteres = document.tweet.twit.value.length;
                if (num_caracteres > 0) {

                    $('.guardarg').attr('value', 'Cargando..');
                    $('.twit').attr('value', '');
                    $(".newtweet").html("<img src='./img/spinner.gif'/>");
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./controller/cyclic",
                        data: "twit=" + twit + "&tweet=" + tweet,
                        success:
                                function(data) {
                                    // $('#pktweet').html(data);
                                    if (data == 'fallo') {
                                        alert('Lo siento este tweet ya lo has escrito antes. No puedes repetirlo');
                                        $(".newtweet").remove();
                                        $("#pktweet").prepend("<div class='newtweet' style='text-align: center;'></div>");
                                    } else {
                                        $("#pktweet").prepend("<div class='nwtw" + data + "'></div>");
                                        $(".nwtw" + data).load("./controller/listas", function() {
                                            $(".newtweet").remove();
                                            $("#pktweet").prepend("<div class='newtweet' style='text-align: center;'></div>");
                                        });
                                    }
//                                  $("#column-header").load("content.php");
//                                   console.log('mundo');
                                    $('.guardarg').attr('value', 'Agregar a la lista');
//                                    mostrar();
                                }

                    });
                    $('.twit').val('');
                }
            }

            function algo2() {
                var twit = $('.twit2').val();
                var num_caracteres = document.tweet2.twit2.value.length;
                if (num_caracteres > 0) {
                    $('.guardarg2').attr('value', 'Cargando..');
                    $('.twit2').attr('value', '');
                    $(".newtweet2").html("<img src='./img/spinner.gif'/>");
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./controller/directmessage",
                        data: "direct=" + twit + '&id=' + <?php echo $this->data['idcuentatwitter']; ?>,
                        success:
                                function(data) {
//                        $('#pktweet').html(data);
//alert(data);

                                    $("#pktweet2").load("./controller/listdirect/" + <?php echo $this->data['idcuentatwitter']; ?>);
                                    $(".newtweet2").html("");
                                    $('.guardarg2').attr('value', 'Agregar a la lista');
//                            mostrar();
                                }

                    });
                    $('.twit').val('');
                }
            }

            function directelim(id2) {
                var laclase2 = ".directforelima" + id2;
                $(laclase2).html('Cargando...');
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: "./elimdirect/",
                    data: "id=" + id2,
                    success: function() {
                        var laclase2 = ".directforelim" + id2;
                        $(laclase2).slideUp();
                    }
                });
            }

            function mostrar() {
//                $("#loader_gif").fadeOut("slow");
                $("#pktweet").load("./controller/listas");
            }

            function valida_longitud() {
                var contenido_textarea = "";
                var num_caracteres_permitidos = 141;
                var num_caracteres = document.tweet.twit.value.length;
                if (num_caracteres > num_caracteres_permitidos) {

                } else {
                    contenido_textarea = document.tweet.twit.value;
                }

                if (num_caracteres >= num_caracteres_permitidos) {
                    document.tweet.caracteres.style.color = "#ff0000";
                } else {
                    document.tweet.caracteres.style.color = "#000000";
                }

                if (num_caracteres >= num_caracteres_permitidos) {

                    document.getElementById('guardarg').disabled = true;
                } else {
                    document.getElementById('guardarg').disabled = false;
                }
                cuenta();
            }

            function valida_longitud2() {
                var contenido_textarea = "";
                var num_caracteres_permitidos = 125;
                var num_caracteres = document.tweet2.twit2.value.length;
                if (num_caracteres > num_caracteres_permitidos) {

                } else {
                    contenido_textarea = document.tweet2.twit2.value;
                }

                if (num_caracteres >= num_caracteres_permitidos) {
                    document.tweet2.caracteres2.style.color = "#ff0000";
                } else {
                    document.tweet2.caracteres2.style.color = "#000000";
                }

                if (num_caracteres >= num_caracteres_permitidos) {

                    document.getElementById('guardarg2').disabled = true;
                } else {
                    document.getElementById('guardarg2').disabled = false;
                }
                cuenta2();
            }

            function cuenta() {
                document.tweet.caracteres.value = 140 - (document.tweet.twit.value.length);
            }

            function cuenta2() {
                document.tweet2.caracteres2.value = 125 - (document.tweet2.twit2.value.length);
            }

            function drop(id) {
                if (confirm("¿Esta segur@ de eliminar esta cuenta? al eliminar se borraran todas las listas creadas")) {
// Respuesta afirmativa...
                    var cuentas = ".drop" + id;
                    $(cuentas).html("<img src='./img/spinner.gif'/>");
                    $('.elim' + id).html('Eliminando')

                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./controller/eliminarcuenta",
                        data: "id=" + id,
                        success: function() {
                        }
                    });
                    $('.elim' + id).css('display', 'none');
                }

            }
            //----------------------------------------------------------
            function valida_longitud1() {
                var contenido_textarea = "";
                var num_caracteres_permitidos = 141;
                var num_caracteres = document.tweet1.twit1.value.length;
                if (num_caracteres > 0) {

                    $('.guardarg').attr("disabled", false);
                }
                else {
                    $('.guardarg').attr("disabled", true);
                }
                if (num_caracteres > num_caracteres_permitidos) {

                } else {
                    contenido_textarea = document.tweet1.twit1.value;
                }

                if (num_caracteres >= num_caracteres_permitidos) {
                    document.tweet1.caracteres1.style.color = "#ff0000";
                } else {
                    document.tweet1.caracteres1.style.color = "#000000";
                }

                if (num_caracteres >= num_caracteres_permitidos) {

                    document.getElementById('guardarg').disabled = true;
                } else {
                    document.getElementById('guardarg').disabled = false;
                }
                cuenta1();
            }

            function cuenta1() {
                document.tweet1.caracteres1.value = 140 - (document.tweet1.twit1.value.length);
            }

            function actualizar(id) {
                $('.pktweetact').load('./controller/actualizar/' + id);
            }

            function editarinterno(id) {
                console.log(id);
                console.log('aqui');
//                var ss = '#editint'+ id;
//                console.log(ss);
//                console.log($('#editint'+ id).val());
//                $('#editint'+ id).html('as');
                document.getElementById('editint' + id).contentEditable = true;
                $('.savecambio' + id).css('display', 'block')
                $('#editint' + id).focus();
//                $('.editint'+ id).contentEditable = true;
//                        document.getElementById().c
            }

            function configinter(id) {
//                alert(id);
                var intervalo = $('#intervalo').val();
//                alert(intervalo);
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: "./controller/intervalo/" + id,
                    data: "intervalo=" + intervalo,
                    success: function() {
//                        $(ide).html(data);
                    }
                });
                alert('Se ha cambiado el intervalo de su cuenta para enviar un tweet cada ' + intervalo + ' minutos');
            }

            function activarlista(id, estatus) {

                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: "./controller/activarlista/" + id + "/" + estatus,
                    data: "id=" + id + "&estatus=" + estatus,
                    success: function() {
//                        $(ide).html(data);
                    }
                });
//                        redirect('./profile/'+id);
                alert('Espere mientras se recarga la pagina');
                location.reload();
            }

            //----------------------------------------------------------
            function cupon(id) {
                if (confirm("La activaciòn del cupon se hara desde el dìa de hoy y serà valida por 30 dias consecutivos ¿Esta segur@ que desea activar un cupon en esta cuenta?")) {
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "./controller/cupon/" + id,
                        data: "id=" + id,
                        success: function(data) {
//                        $(ide).html(data);
                            if (data == 'si') {
                                alert('Se ha activado su cupon con exito, recargaremos la pagina');
                                location.reload();
                            }
                            else {
                                alert('Usted no tiene cupones disponibles, le sugerimos adquirir uno para disfrutar de los beneficios VIP');
                            }
                        }
                    });
//                        redirect('./profile/'+id);

                }
            }

            function retweet(valor) {
                var parametros = {
                    "d": valor,
                    "id": '<?= $this->data['idcuentatwitter']; ?>'
                };
                $.ajax({
                    data: parametros,
                    url: 'controller/newretweet',
                    type: 'post',
                    beforeSend: function() {
                        $("#resultretweet").html("Procesando, <img src='./img/spinner.gif'/>");
                    },
                    success: function(response) {
                        $("#resultretweet").html(response);
                    }
                });
            }
            function retweetdelete(valor) {
                var parametros = {
                    "d": valor,
                    "id": '<?= $this->data['idcuentatwitter']; ?>'
                };
                $.ajax({
                    data: parametros,
                    url: 'controller/deleteretweet',
                    type: 'post',
                    beforeSend: function() {
                        $("#resultretweet").html("Procesando, <img src='./img/spinner.gif'/>");
                    },
                    success: function(response) {
                        $("#resultretweet").html(response);
                    }
                });
            }



        </script>
        <title>Pk Tweet</title>
    </head>
    <header>
        <? $this->load->view('services'); ?>
    </header>



    <body>
        <!-- BEGIN JIVOSITE CODE {literal} -->
        <script type='text/javascript'>
            (function() {
                var widget_id = 'ZSYJgXbuA7';
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = '//code.jivosite.com/script/widget/' + widget_id;
                var ss = document.getElementsByTagName('script')[0];
                ss.parentNode.insertBefore(s, ss);
            })();</script>
        <!-- {/literal} END JIVOSITE CODE -->
