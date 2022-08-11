<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "SELECT * FROM dashboard where grafico = 'tabelas/resumo/{$_SESSION['filtro_relatorio_municipio']}'";
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

    <?php
    for($i=0;$i<count($Rotulos);$i++){
    ?>
    <div class="col-md-3">
        <div class="painel" style="background-color:blue;">
            <h5><?=$Rotulos[$i]?></h5>
            <h3><?=$Quantidade[$i]?></h3>
        </div>
    </div>
    <?php
    }
    ?>

</div>