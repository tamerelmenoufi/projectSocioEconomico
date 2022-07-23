<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>

<div class="container">
    <div class="row mt-3">
        <div class="d-flex justify-content-between">
            <div class="p-10"><h3>Usuários do Sistema</h3></div>
            <div class="p-2">
                <button class="btn btn-primary">
                    Novo
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-3">

        <div class="row">
            <div class='col-md-4'>NOME</div>
            <div class='col-md-4'>E-MAIL</div>
            <div class='col-md-2'>SITUAÇÃO</div>
            <div class='col-md-2'>AÇÕES</div>
        </div>

        <?php
            $query = "select * from usuarios order by nome";
            $result = mysqli_query($con, $query);
            while($d = mysqli_fetch_object($result)){
        ?>
        <div class="row">
            <div class='col-md-4'><?=$d->nome?></div>
            <div class='col-md-4'><?=$d->email?></div>
            <div class='col-md-2'><?=$d->situacao?></div>
            <div class='col-md-2'>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-danger">
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