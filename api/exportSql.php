<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "SELECT * FROM `COLUMNS` where TABLE_SCHEMA = 'app' and COLUMN_NAME != 'codigo' and TABLE_NAME != 'zonas_manaus' order by TABLE_NAME";
    $result = mysqli_query($conApi, $query);
    while($d = mysqli_fetch_object($result)){
        $Comando[$d->TABLE_NAME][] = $d->COLUMN_NAME;
    }

    $Cmd = [];
    foreach($Comando as $ind => $val){
        $cmd = "CREATE TABLE IF NOT EXISTS {$ind} (";
        $campos = [];
        foreach($val as $i => $v){
            $cmd .= $v." TEXT, ";
            $campos[] = $v;
        }
        $cmd .= "codigo INTEGER PRIMARY KEY AUTOINCREMENT);";

        $Cmd[] = ['comando' => "DROP TABLE {$ind}"];
        $Cmd[] = ['comando' => $cmd];

        $query = "select * from {$ind}";
        $result = mysqli_query($con, $query);
        while($d = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Cmd[] = ['comando' => "INSERT INTO $ind (codigo, ".implode(", ", $campos).") VALUES ('".implode("', '",$d)."')"];
        }

    }



    echo json_encode($Cmd);

