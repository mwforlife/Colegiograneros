<?php
    $inicial = $_GET['inicial'];
    $type = $_GET['type'];
    $cantidad = $_GET['cantidad'];


    for ($i=0; $i < $cantidad; $i++) { 
        echo "<img class='barra' src='barcode.php?text=".$type.$inicial."&size=50&orientation=horizontal&codetype=Code39&print=true&sizefactor=1'>";
        $inicial++;
    }

?>