<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $Cmd[] = ['comando' => $_POST['perfil']];

    echo json_encode($_POST);

