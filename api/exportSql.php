<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "SELECT * FROM `COLUMNS` where TABLE_SCHEMA = 'app' and COLUMN_NAME != 'codigo' order by TABLE_NAME";
    $result = mysqli_query($conApi, $query);
    while($d = mysqli_fetch_object($result)){
        $Comando[$d->TABLE_NAME][] = $d->COLUMN_NAME;
    }

    $Cmd = [];
    foreach($Comando as $ind => $val){
        $cmd = $ind."CREATE TABLE IF NOT EXISTS {$ind} (";
        foreach($val as $i => $v){
            $cmd .= $v." TEXT, ";
        }
        $cmd .= "codigo INTEGER PRIMARY KEY AUTOINCREMENT);";

        $Cmd[] = $cmd;
    }

    echo json_encode($Cmd);
