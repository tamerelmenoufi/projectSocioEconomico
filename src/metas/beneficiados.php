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
            <?=str_pad($m->codigo, 6, "0", STR_PAD_LEFT)?><br>
            <?=$m->nome?><br>
            <?=$m->municipio_nome?><br>
            <?=$m->bairro_nome?>
          </div>
        </div>
        
        <h6 style="position:absolute; top:270px; left:0; right:0; width:100%; background-color:#fff; padding:5px;">Dados do Beneficiados</h6>
        <div style="position:absolute; top:300px; bottom:60px; left:0; right:0; overflow-y: scroll;">
          <table class="table table-hover">
              <?php
              $query = "select * from se where municipio = '{$m->municipio}' and bairro_comunidade = '{$m->bairro_comunidade}' and local = '{$m->zona}'";
              $result = mysqli_query($con, $query);
              while($d = mysqli_fetch_object($result)){
              ?>
              <tr>
                  <td>

                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="opc<?=$d->codigo?>">
                    <label class="form-check-label" for="opc<?=$d->codigo?>"><?=$d->nome?></label>
                  </div>

                    
                  </td>
              </tr>
              <?php
              }
              ?>
          </table>
        </div>
        
        <bottom style="position:absolute; bottom:10px; right:30px;" class="btn btn-success">Salvar</bottom>
      </div>
    </div>
  </div>
</div>