<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>
<div class="list-group">
<?php
    $query = "select * from pacs where situacao = '1' and deletado != '1'";
    $result = mysqli_query($con, $query);
    while($d = mysqli_fetch_object($result)){
?>
  <button type="button" class="list-group-item list-group-item-action"><i class="fa-solid fa-square" style="color:<?=$d->cor?>"></i> <?=$d->nome?></button>
<?php
    }
?>
</div>