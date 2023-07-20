<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if(!is_dir('logs')) mkdir('logs');

    file_put_contents(date("YmdHis").".txt", print_r(json_decode($_POST), true));

