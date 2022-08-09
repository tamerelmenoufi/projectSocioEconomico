<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

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
    <div class="col-md-3">
        <div class="painel" style="background-color:blue;">
            <h5>Total de Beneficiários</h5>
            <h3>Carregando...</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="painel" style="background-color:orange;">
            <h5>Pesquisas Iniciadas</h5>
            <h3>Carregando...</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="painel" style="background-color:grey;">
            <h5>Pesquisas Pendentes</h5>
            <h3>Carregando...</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="painel" style="background-color:green;">
            <h5>Pesquisas Concluídas</h5>
            <h3>Carregando...</h3>
        </div>
    </div>
</div>