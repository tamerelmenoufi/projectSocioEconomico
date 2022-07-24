<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
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
                <select name="municipio" id="municipio">
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
                <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$d->email?>">
                <label for="email">Bairro</label>
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

    })
</script>