<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
    $_POST = json_decode(file_get_contents('php://input'), true);
    $dados = json_encode($_POST);

    if(!is_dir('logs')) mkdir('logs');

    file_put_contents(date("YmdHis").".txt", $dados);

