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
            </div>
        </div>
    </div>

    <div class="row mt-3">

        <div class="d-none d-md-block mb-2">
            <div class="row">
                <div class='col-md-3'><b>LOCALIZAÇÃO</b></div>
                <div class='col-md-3'><b>IDENTIFICAÇÃO</b></div>
                <div class='col-md-2'><b>CONTATO</b></div>
                <div class='col-md-2'><b>SITUAÇÃO</b></div>
                <div class='col-md-2'><b>AÇÕES</b></div>
            </div>
        </div>

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
        <div class="row" style="border-bottom:1px #ccc solid; margin-bottom:2px; margin-top:2px;">
            <div class='col-md-3'><?=$d->municipio?><br><?=$d->bairro_comunidade?></div>
            <div class='col-md-3'><?=$d->nome?><br><?=$d->cpf?></div>
            <div class='col-md-2'><?=$d->telefone?><br><?=$d->email?></div>
            <div class='col-md-2'><?=$d->situacao?></div>
            <div class='col-md-2'>
                <div class="d-flex justify-content-between">
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
    })
</script>