<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
    $_POST = json_decode(file_get_contents('php://input'), true);


    $query = "SELECT * FROM `COLUMNS` where TABLE_SCHEMA = 'app' and COLUMN_NAME != 'codigo' and TABLE_NAME = 'se' order by TABLE_NAME";
    $result = mysqli_query($conApi, $query);
    while($d = mysqli_fetch_object($result)){
        $campos[] = $d->COLUMN_NAME;
        $tipos[$d->COLUMN_NAME] = $d->DATA_TYPE;
    }


    $query = "select * from se limit 50";
    $result = mysqli_query($con, $query);
    while($d = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $D = [];
        foreach($d as $i => $v){
            if(strtolower($tipos[$i]) == 'bigint' or strtolower($tipos[$i]) == 'int'){
                $D[] = str_replace(",", "`", $v);
            }else{
                $D[] = "'".str_replace("'", "`", $v)."'";
            }
            
        }
        $Cmd[] = ['comando' => "REPLACE INTO se (codigo, ".implode(", ", $campos).") VALUES (".implode(", ",$D).")"];
    } 



    $Cmd[] = ['comando' => $_POST['perfil']];

    echo json_encode($Cmd);

