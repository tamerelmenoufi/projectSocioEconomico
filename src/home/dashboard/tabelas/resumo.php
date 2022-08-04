<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "select
        (select count(*) from se) as total,
        (select count(*) from se where percentual > 0 and percentual < 100) as iniciadas,
        (select count(*) from se where percentual = 0) as pendentes,
        (select count(*) from se where percentual = 100) as concluidas
    ";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

?>
<div class="col">
    <div class="col-md-3">
        <h4>Total de Beneficiários</h4>
        <h1><?=$d->total?></h1>
    </div>

    <div class="col-md-3">
        <h4>Pesquisas Iniciadas</h4>
        <h1><?=$d->iniciadas?></h1>
    </div>

    <div class="col-md-3">
        <h4>Pesquisas Pendentes</h4>
        <h1><?=$d->pendentes?></h1>
    </div>

    <div class="col-md-3">
        <h4>Pesquisas Concluídas</h4>
        <h1><?=$d->concluidas?></h1>
    </div>
</div>