<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    function array_multisum($arr){
        $sum = array_sum($arr);
        foreach($arr as $child) {
            $sum += is_array($child) ? array_multisum($child) : 0;
        }
        return $sum;
    }

    function array_indices($arr){
        // $ind = [];
        foreach($arr as $child => $val) {
            $ind[] = $child;
            if(is_array($val)) array_indices($val);
        }
        return $ind;
    }

    $query = "SELECT
                    a.municipio as cod_municipio,
                    a.bairro_comunidade as cod_bairro,
                    m.municipio,
                    b.descricao,
                    a.local,
                    a.zona_urbana,
                    a.situacao,
                    count(*) quantidade
                FROM se a
                    left join municipios m on a.municipio = m.codigo
                    left join bairros_comunidades b on a.bairro_comunidade = b.codigo
                group by
                        a.municipio,
                        a.bairro_comunidade,
                        a.local,
                        a.zona_urbana,
                        a.situacao";

    $result = mysqli_query($con,$query);
    while($d = mysqli_fetch_object($result)){
        $_SESSION['municipios']['quantidade'][$d->cod_municipio][$d->local][$d->zona_urbana][$d->cod_bairro][$d->situacao] = $d->quantidade;
        $_SESSION['municipios']['nome'][$d->cod_municipio] = $d->municipio;
        $_SESSION['bairro']['nome'][$d->cod_bairro] = $d->descricao;
    }

    if($_SESSION['filtro_relatorio_municipio'] == 66){
        print_r(array_indices($_SESSION['municipios']))."<hr>";
        echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].': '.array_multisum($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']])."<br>";
        foreach($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']]['Urbano'] as $indice => $valores){
            echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].'Urbano - '.$indice.': '.array_multisum($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']]['Urbano'][$indice])."<br>";
        }
    }else{
        print_r(array_indices($_SESSION['municipios']))."<hr>";
        echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].': '.array_multisum($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']])."<br>";
        echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].'Urbano: '.array_multisum($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']]['Urbano'])."<br>";
        echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].'Rural: '.array_multisum($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']]['Rural'])."<br>";
    }

    // foreach($_SESSION['bairro']['nome'] as $indice => $valor){

    //     echo $indice.' em '.$valor."<br>";

    // }

?>

<script>
    $(function(){
        Carregando('none')

    })
</script>