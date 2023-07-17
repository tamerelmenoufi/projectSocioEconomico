<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "SELECT * FROM `COLUMNS` where TABLE_SCHEMA = 'app' and COLUMN_NAME != 'codigo' order by TABLE_NAME";
    $result = mysqli_query($conApi, $query);
    while($d = mysqli_fetch_object($result)){
        $Comando[$d->TABLE_NAME][] = $d->COLUMN_NAME;
    }


    foreach($Comando as $ind => $val){
        echo $ind."<br>";
        foreach($val as $i => $v){
            echo "---".$v."<br>";
        }
    }