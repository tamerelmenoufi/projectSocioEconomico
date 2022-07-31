<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>
<style>

</style>

<h3>Aqui é a lista completa</h3>
<?php

$query = "select * from se_estrutura_familiar where se_codigo = '{$_SESSION['se_codigo']}'";
$result = mysqli_query($con, $query);
while($d = mysqli_fetch_object($result)){
?>

<div class="row">
            <div class="col">
                <div class="card mt-3">
                    <h5 class="card-header"><?=$d->ef_nome?> - <?=$d->ef_grau_parentesco?></h5>
                    <div class="card-body">

                        <h5 class="card-title"><?=$d->ef_telefone?></h5>
                        <p class="card-text">
                            Outras Informações
                        </p>

                        <button
                            class="btn btn-primary"
                            data-bs-toggle="offcanvas"
                            href="#offcanvasDireita"
                            role="button"
                            aria-controls="offcanvasDireita"
                            pesquisaSe="<?=$d->codigo?>"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <button
                            class="btn btn-danger"
                            data-bs-toggle="offcanvas"
                            href="#offcanvasDireita"
                            role="button"
                            aria-controls="offcanvasDireita"
                            SeEf="<?=$d->codigo?>"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>


                    </div>
                </div>
            </div>
        </div>

<?php
}
?>
<script>
    $(function(){

        Carregando('none');


    })
</script>