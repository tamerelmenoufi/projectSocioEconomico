<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if($_POST['beneficiados']) $_SESSION['metas'] = $_POST['beneficiados'];

    $query = "select a.*,
                     b.nome,
                     c.municipio as municipio_nome,
                     d.descricao as bairro_nome
            from metas a 
                    left join usuarios b on a.usuario = b.codigo 
                    left join municipios c on a.municipio = c.codigo 
                    left join bairros_comunidades d on a.bairro_comunidade = d.codigo 
            where a.codigo = '{$_SESSION['metas']}'";
    $result = mysqli_query($con, $query);
    $m = mysqli_fetch_object($result);
?>

<div class="col">
  <div class="m-3">
    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Lista de Usuários</h5>
          <div class="card-body">
            <?=$d->codigo?><br>
            <?=$d->nome?><br>
            <?=$d->municipio_nome?><br>
            <?=$d->bairro_nome?>

            <table class="table">
                <tr>
                    <td></td>
                </tr>
            </table>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>