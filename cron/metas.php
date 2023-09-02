<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "select * from metas where data >= NOW()";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result)){
        $metas = [];
        while($d = mysqli_fetch_object($result)){
            $metas[] = $d->codigo;
        }
        echo $q = "update se set meta = '0' where codigo not in (".implode(", ", $metas).")";
    }