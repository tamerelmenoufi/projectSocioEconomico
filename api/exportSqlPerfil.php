<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $Cmd[] = ['comando' => $_GET['perfil']];

    echo json_encode($Cmd);

