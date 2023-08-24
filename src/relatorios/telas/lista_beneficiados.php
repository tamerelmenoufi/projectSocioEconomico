<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $filtro = $f_usuario = $f_meta = $f_data = $f_campo = false;
    if($_SESSION['relatorio']['usuario']){
        $f_usuario = " and a.monitor_social in( {$_SESSION['relatorio']['usuario']} ) ";
    }
    if($_SESSION['relatorio']['meta']){
        $f_meta = " and a.meta in( {$_SESSION['relatorio']['meta']} ) ";
    }
    if($_SESSION['relatorio']['data_inicial']){
        $f_data = " and (a.data between '{$_SESSION['relatorio']['data_inicial']} 00:00:00' and '".(($_SESSION['relatorio']['data_final'])?:$_SESSION['relatorio']['data_inicial'])." 23:59:59')";
    }
    if($_POST['campo'] and $_POST['json']){
        $f_campo = " and {$_POST['campo']} like '%\"{$_POST['valor']}\"%' ";
    }else if($_POST['campo']){
        $f_campo = " and {$_POST['campo']} = '{$_POST['valor']}' ";
    }

    $filtro = $f_usuario . $f_meta . $f_data . $f_campo;


    $query = "select a.* from se a where a.monitor_social > 0 and a.meta > 0 {$filtro}";
    $result = mysqli_query($con, $query);
    $t = 0;
    while($s = mysqli_fetch_object($result)){
        echo $s->nome."<br>";
    }