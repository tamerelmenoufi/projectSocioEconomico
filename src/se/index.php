<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>

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