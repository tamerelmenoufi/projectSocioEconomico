<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "SELECT * FROM dashboard where grafico = 'tabelas/resumo'";
    $result = mysqli_query($con, $query);
    $Rotulos = [];
    $Quantidade = [];
    $d = mysqli_fetch_object($result);
    $esquema = json_decode($d->esquema);
    $Rotulos = $esquema->Rotulos;
    $Quantidade = $esquema->Quantidade;

?>
<style>
    .painel{
        display:flex;
        flex-direction:column;
        width:80%;
        height:90px;
        border-radius:9px;
        text-align:center;
        justify-content:center;
        align-items:center;
        color:#fff;
    }
</style>
<div class="row" style="margin:0; padding:0;">
    <!-- <div class="col-md-3">
        <div class="painel" style="background-color:blue;">
            <h5>Total de Beneficiários</h5>
            <h3><?=$d->total?></h3>
        </div>
    </div> -->
    <?php
    for($i=0;$i<count($Rotulos);$i++){
    ?>
    <div class="col-md-3">
        <div class="painel" style="background-color:orange;">
            <h5><?=$Rotulos[$i]?></h5>
            <h3><?=$Quantidade[$i]?></h3>
        </div>
    </div>
    <?php
    }
    ?>


    <!-- <div class="col-md-3">
        <div class="painel" style="background-color:grey;">
            <h5>Pesquisas Pendentes</h5>
            <h3><?=$d->pendentes?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="painel" style="background-color:green;">
            <h5>Pesquisas Concluídas</h5>
            <h3><?=$d->concluidas?></h3>
        </div>
    </div> -->
</div>