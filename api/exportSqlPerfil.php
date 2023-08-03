<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
    $_POST = file_get_contents('php://input');


    $Cmd[] = ['comando' => $_POST['perfil']];

    echo json_encode($Cmd);

