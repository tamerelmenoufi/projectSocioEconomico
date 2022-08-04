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
<style>
    .painel{
        width:80%;
        height:90px;
        background-color:blue;
        border:solid 1px blue;
        border-radius:9px;
    }
</style>
<div class="row" style="margin:0; padding:0;">
    <div class="col-md-3 painel">
        <div class="painel">
            <h5>Total de Beneficiários</h5>
            <h3><?=$d->total?></h3>
        </div>
    </div>

    <div class="col-md-3 painel">
        <div class="painel">
            <h5>Pesquisas Iniciadas</h5>
            <h3><?=$d->iniciadas?></h3>
        </div>
    </div>

    <div class="col-md-3 painel">
        <div class="painel">
            <h5>Pesquisas Pendentes</h5>
            <h3><?=$d->pendentes?></h3>
        </div>
    </div>

    <div class="col-md-3 painel">
        <div class="painel">
            <h5>Pesquisas Concluídas</h5>
            <h3><?=$d->concluidas?></h3>
        </div>
    </div>
</div>