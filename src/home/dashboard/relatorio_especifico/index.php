<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
    // exit();

    if(!$_SESSION['filtro_especifico']) exit();


    echo $query = "select * from se where {$_SESSION['filtro_especifico']}";


?>

<h5>Relatório Específico</h5>
<p></p>