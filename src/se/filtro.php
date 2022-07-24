<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if($_POST['acao'] == 'bairro_comunidade'){

        $q = "select * from bairros_comunidades

                where
                        municipio = '{$_POST['bairro_comunidade']}'
                        /*and tipo = '{$_POST['tipo']}'*/

                order by descricao";
        $r = mysqli_query($con, $q);
?>
        <option value="">::Selecione a Localização::</option>
<?php
        while($s = mysqli_fetch_object($r)){
?>
        <option value="<?=$s->codigo?>"><?=$s->descricao?> (<?=$s->tipo?>)</option>
<?php
        }
        exit();
    }
?>

<style>
    .Titulo<?=$md5?>{
        position:absolute;
        left:60px;
        top:8px;
        z-index:0;
    }
</style>
<h4 class="Titulo<?=$md5?>">Filtro de Busca</h4>

<form id="form-<?= $md5 ?>">
    <div class="row">
        <div class="col">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" value="<?=$d->nome?>">
                <label for="nome">Nome*</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF" value="<?=$d->cpf?>">
                <label for="cpf">CPF*</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF" value="<?=$d->cpf?>">
                <label for="cpf">RG*</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="telefone" id="telefone" class="form-control" placeholder="telefone" value="<?=$d->telefone?>">
                <label for="telefone">Telefone*</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$d->email?>">
                <label for="email">E-mail*</label>
            </div>

            <div class="form-floating mb-3">
                <select name="municipio" id="municipio" class="form-control" placeholder="Município">
                    <option value="">::Selecione o Município::</option>
                    <?php
                        $q = "select * from municipios order by municipio";
                        $r = mysqli_query($con, $q);
                        while($s = mysqli_fetch_object($r)){
                    ?>
                    <option value="<?=$s->codigo?>"><?=$s->municipio?></option>
                    <?php
                        }
                    ?>
                </select>
                <label for="email">Município</label>
            </div>

            <div class="form-floating mb-3">
                <select name="tipo" id="tipo" class="form-control" placeholder="Zona">
                    <option value="">::Selecione a Zona::</option>
                    <option value="Urbana">Urbana</option>
                    <option value="Rural">Rural</option>
                </select>
                <label for="tipo">Zona</label>
            </div>

            <div class="form-floating mb-3">
                <select name="bairro_comunidade" id="bairro_comunidade" class="form-control" placeholder="Bairro">
                    <option value="">::Selecione a Localização::</option>
                    <?php
                        $q = "select * from bairros_comunidades where municipio = '{$_SESSION['filtro_municipio']}' order by descricao";
                        $r = mysqli_query($con, $q);
                        while($s = mysqli_fetch_object($r)){
                    ?>
                    <option value="<?=$s->codigo?>"><?=$s->descricao?> (<?=$s->tipo?>)</option>
                    <?php
                        }
                    ?>
                </select>
                <label for="bairro_comunidade">Bairro/Comunidade</label>
            </div>


            <div class="form-floating mb-3">
                <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$d->email?>">
                <label for="email">Região</label>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col">
            <div style="display:flex; justify-content:end">
                <button type="submit" SalvarFoto class="btn btn-success btn-ms">Salvar</button>
                <input type="hidden" id="codigo" value="<?=$_POST['cod']?>" />
            </div>
        </div>
    </div>
</form>

<script>
    $(function(){
        Carregando('none');

        $("#tipo").change(function(){
            bairro_comunidade = $("#municipio").val();
            tipo = $(this).val();
            if(!bairro_comunidade){
                $.alert('Favor selecione o município!');
                return false;
            }
            $.ajax({
                url:"src/se/filtro.php",
                type:"POST",
                data:{
                    bairro_comunidade,
                    tipo,
                    acao:'bairro_comunidade'
                },
                success:function(dados){
                    $("#bairro_comunidade").html(dados);
                }
            });
        });


    })
</script>