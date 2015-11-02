
<link href="../css/font/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="../css/font/styles.css" rel="stylesheet" type="text/css" />
<?php

        echo "<table border='1' style='font-size: 50px; text-align: center;'>";
         $n = 1;
            echo "<tr><td>" . ($n-1) . "</td><td><i class='icon2-trash'></i></td><td>icon-trash</td></tr>";
        $query=$this->modelo_universal->select("iconos", "*",null,null,null,"icono","asc");
//        $query = mysql_query("SELECT * FROM iconos ORDER BY icono");
foreach ($query as $t){
//        debug($query);
       
//        while ($row = mysql_fetch_array($query)) {

            echo "<tr><td>" . $n . "</td><td><i data-icon='a' class='icon  " . $t['icono'] . "'> </i><td>" . $t['icono'] . "</td></tr>";
            $n++;
        }
        echo "</table>";
    
?>
