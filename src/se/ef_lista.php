<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $query = "select * from se where codigo = '{$_POST['cod']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);
?>
<style>

</style>

<h3>Aqui é a lista completa</h3>

<script>
    $(function(){

        Carregando('none');


    })
</script>