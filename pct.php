<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "select * from se where situacao = 'c'";
    $result = mysqli_query($con, $query);
    while($d = mysqli_fetch_object($result)){
        var_dump($d);
        echo "<hr>";
    }