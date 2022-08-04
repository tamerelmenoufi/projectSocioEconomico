<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "select
        (select count(*) from se) as total,
        (select count(*) from se where percentual > 0 and percentual < 100) as iniciadas,
        (select count(*) from se where percentual = 0) as pendentes,
        (select count(*) from se where percentual = 100) as concluidas
    ";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($query);

?>

<div class="row">
    <div class="col-md-3">
        <h2>Total de Beneficiários</h2>
        <h1><?=$d->total?></h1>
    </div>

    <div class="col-md-3">
        <h2>Pesquisas Iniciadas</h2>
        <h1><?=$d->iniciadas?></h1>
    </div>

    <div class="col-md-3">
        <h2>Pesquisas Pendentes</h2>
        <h1><?=$d->pendentes?></h1>
    </div>

    <div class="col-md-3">
        <h2>Pesquisas Concluídas</h2>
        <h1><?=$d->concluidas?></h1>
    </div>

</div>