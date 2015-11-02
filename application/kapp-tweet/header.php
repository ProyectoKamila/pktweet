<? /* debug($this->data['resultado'][0]['nombre']); */ ?>
<!DOCTYPE html>
<html>
    <head>
        <base href="<? echo base_url(); ?>" />
        <meta charset="UTF-8">
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/modal.css" rel="stylesheet" type="text/css" />
        <link href="css/services.css" rel="stylesheet" type="text/css" />
        <link href="./scripts/modal_files/bootstrap.css" rel="stylesheet"> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="./scripts/modal_files/jquery.js"></script>
        <script src="./scripts/modal_files/bootstrap-modal.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
//                $("#boton").click(function() {
//                   $("#target").toggleClass("open");
//                    $(".columns-content").toggleClass("topen");
//                   if($('topen')){
//                       consolo.log("si");
//                    }else{
//                        consolo.log("no");   
//                    }
//                   $("#boton").toggleClass("b");
//                });
                $("#boton1").click(function() {
                    $("#target1").toggleClass("open");
                    $(".columns-content").toggleClass("topen");
                    $("#boton1").toggleClass("b");
                    $("#boton1").toggleClass("b1");

                });
                $("#profile").click(function() {
                    $("#profile1").toggleClass("profile1");
                    $("#profile2").toggleClass("profile1");
                    $("#profile3").toggleClass("profile1");
                });
                $("#profile_1").click(function() {
                    $("#profile11").toggleClass("profile1");
                    $("#profile21").toggleClass("profile1");
                    $("#profile31").toggleClass("profile1");
                });
                $("#count").click(function() {
                    console.log("click");
                    $("#count").toggleClass("pli");
                    $("#counta").toggleClass("pa");
                    $("#sub").toggleClass("profile1");
                });
                $("#togg0").click(function(){
                    $("#margin0").toggleClass("margin-open");
                    $("#togg-article0").toggleClass("togg-article-open");
                });
                $("#togg1").click(function(){
                    $("#margin1").toggleClass("margin-open");
                    $("#togg-article1").toggleClass("togg-article-open");
                });
                $("#togg2").click(function(){
                    $("#margin2").toggleClass("margin-open");
                    $("#togg-article2").toggleClass("togg-article-open");
                });

            });
        </script>
        <script>
//var contenido_textarea = ""; 
//var num_caracteres_permitidos = 10; 
            function valida_longitud() {
                var contenido_textarea = "";
                var num_caracteres_permitidos = 141;
                var num_caracteres = document.tweet.texto.value.length;

                if (num_caracteres > num_caracteres_permitidos) {
//       alert('se paso');
//      document.tweet.texto.value = contenido_textarea;

                } else {
                    contenido_textarea = document.tweet.texto.value;
                }

                if (num_caracteres >= num_caracteres_permitidos) {
                    document.tweet.caracteres.style.color = "#ff0000";
//      cambiar();

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
            function cambiar() {


            }
            function cuenta() {
                document.tweet.caracteres.value = (140 - document.tweet.texto.value.length);
            }
        </script>
        <title>Kapp Tweet</title>
    </head>
    <header>
        <? $this->load->view('services'); ?>
    </header>
    <body>
