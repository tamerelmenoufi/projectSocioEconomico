<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    function Filtros(){
        global $_SESSION;
        global $con;
        $retorno = [];
        if($_SESSION['filtro_nome']){
            $retorno[] = "<span class='rotuloFultro'>{$_SESSION['filtro_nome']} <i class='fa-solid fa-xmark' delFiltro='filtro_nome'></i></span>";
        }
        if($_SESSION['filtro_cpf']){
            $retorno[] = "<span class='rotuloFultro'>{$_SESSION['filtro_cpf']} <i class='fa-solid fa-xmark' delFiltro='filtro_cpf'></i></span>";
        }
        if($_SESSION['filtro_rg']){
            $retorno[] = "<span class='rotuloFultro'>{$_SESSION['filtro_rg']} <i class='fa-solid fa-xmark' delFiltro='filtro_rg'></i></span>";
        }
        if($_SESSION['filtro_telefone']){
            $retorno[] = "<span class='rotuloFultro'>{$_SESSION['filtro_telefone']} <i class='fa-solid fa-xmark' delFiltro='filtro_telefone'></i></span>";
        }
        if($_SESSION['filtro_email']){
            $retorno[] = "<span class='rotuloFultro'>{$_SESSION['filtro_email']} <i class='fa-solid fa-xmark' delFiltro='filtro_email'></i></span>";
        }
        if($_SESSION['filtro_municipio']){
            list($dado) = mysqli_fetch_row(mysqli_query($con, "select municipio from municipios where codigo = '{$_SESSION['filtro_municipio']}'"));
            $retorno[] = "<span class='rotuloFultro'>{$dado} <i class='fa-solid fa-xmark' delFiltro='filtro_municipio'></i></span>";
        }
        if($_SESSION['filtro_tipo']){
            $retorno[] = "<span class='rotuloFultro'>{$_SESSION['filtro_tipo']} <i class='fa-solid fa-xmark' delFiltro='filtro_tipo'></i></span>";
        }
        if($_SESSION['filtro_bairro_comunidade']){
            list($dado) = mysqli_fetch_row(mysqli_query($con, "select descricao from bairros_comunidades where codigo = '{$_SESSION['filtro_bairro_comunidade']}'"));
            $retorno[] = "<span class='rotuloFultro'>{$dado} <i class='fa-solid fa-xmark' delFiltro='filtro_bairro_comunidade'></i></span>";
        }

        if($retorno){
            echo '<b>FILTRO: </b>' . implode(" ", $retorno);
        }

    }

?>
<style>
    .rotuloFultro{
        padding:5px;
        background-color:#d2ffc8;
        border-radius:7px;
        border:#eee;
        font-size:12px;
        color:#333;
        width:auto;
        margin:2px;
        float:left;
    }
    .rotuloFultro i{
        color:red;
        font-size:14px;
        font-weight:bold;
        padding:5px;
    }
</style>
<div class="container">
    <div class="row mt-3">
        <div class="d-flex justify-content-between">
            <div class="p-10"><h3>Registros de Beneficiarios</h3></div>
            <div class="p-2">
                <button class="btn btn-primary">
                    Novo
                </button>

                <button
                    class="btn btn-warning"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasDireita"
                    role="button"
                    aria-controls="offcanvasDireita"
                    BuscaFiltro
                >
                    Filtro
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-3">

        <?php

            Filtros();

            $query = "select
                            a.*,
                            b.municipio as municipio,
                            c.descricao as bairro_comunidade
                        from se a
                            left join municipios b on a.municipio = b.codigo
                            left join bairros_comunidades c on a.bairro_comunidade = c.codigo
                        order by nome limit 0, 20";
            $result = mysqli_query($con, $query);
            while($d = mysqli_fetch_object($result)){
        ?>

        <div class="row">
            <div class="col">
                <div class="card mt-3">
                    <h5 class="card-header"><?=$d->nome?> - <?=$d->cpf?></h5>
                    <div class="card-body">

                        <h5 class="card-title"><?=$d->municipio?> - <?=$d->bairro_comunidade?> (<?=$d->local?>)</h5>
                        <p class="card-text">
                            <?=$d->telefone?><br><?=$d->email?><br><?=$d->situacao?>
                        </p>

                        <button
                            class="btn btn-success"
                            data-bs-toggle="offcanvas"
                            href="#offcanvasDireita"
                            role="button"
                            aria-controls="offcanvasDireita"
                            editarSe="<?=$d->codigo?>"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button
                            class="btn btn-danger"
                            excluirSe="<?=$d->codigo?>"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </div>
                </div>
            </div>
        </div>

        <?
            }
        ?>
    </div>
</div>

<script>
    $(function(){
        $("button[editarSe]").click(function(){

            cod = $(this).attr("editarSe");
            Carregando();
            $.ajax({
                url:"src/se/form.php",
                type:"POST",
                data:{
                    cod,
                },
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })

        });


        $("button[BuscaFiltro]").click(function(){

            Carregando();
            $.ajax({
                url:"src/se/filtro.php",
                type:"POST",
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })

        });
    })
</script>