<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    $query = "SELECT a.codigo as cod_municipio, a.bairro_comunidade as cod_bairro, m.municipio, b.descricao, local, b.zona_urbana, count(*) quantidade FROM se a
    left join municipios m on a.municipio = m.codigo
    left join bairros_comunidades b on a.bairro_comunidade = b.codigo
    group by a.municipio, a.bairro_comunidade, a.local, b.zona_urbana";

    $result = mysqli_query($con,$query);
    while($d = mysqli_fetch_object($result)){

        $_SESSION['municipios']['quantidade'][$d->cod_municipio][$d->cod_bairro][$d->local][$d->zona_urbana] = $d->quantidade;
        $_SESSION['municipios']['nome'][$d->cod_municipio] = $d->municipio;
        $_SESSION['bairro']['nome'][$d->cod_bairro] = $d->descricao;
    }

    echo "Geral: ".sum_array($_SESSION['municipios']['quantidade'])."<br>";

    // foreach($_SESSION['bairro']['nome'] as $indice => $valor){

    //     echo $indice.' em '.$valor."<br>";

    // }

?>

<script>
    $(function(){
        Carregando('none')

    })
</script>