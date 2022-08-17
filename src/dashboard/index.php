<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    function array_multisum($arr){
        $sum = array_sum($arr);
        foreach($arr as $child) {
            $sum += is_array($child) ? array_multisum($child) : 0;
        }
        return $sum;
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
                        a.local,
                        a.zona_urbana,
                        a.bairro_comunidade,
                        a.situacao";

    $result = mysqli_query($con,$query);
    while($d = mysqli_fetch_object($result)){
        $_SESSION['municipios']['quantidade'][$d->cod_municipio][$d->local][$d->zona_urbana][$d->cod_bairro][$d->situacao] = $d->quantidade;
        $_SESSION['municipios']['nome'][$d->cod_municipio] = $d->municipio;
        $_SESSION['bairro']['nome'][$d->cod_bairro] = $d->descricao;
    }

    if($_SESSION['filtro_relatorio_municipio'] == 66){
        echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].': '.array_multisum($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']])."<br>";
        foreach($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']]['Urbano'] as $indice => $valores){
            echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].'Urbano - '.$indice.': '.array_multisum($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']]['Urbano'][$indice])."<br>";
        }
    }else if($_SESSION['filtro_relatorio_municipio']){
        echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].': '.array_multisum($_SESSION['municipios']['quantidade'][$_SESSION['filtro_relatorio_municipio']])."<br>";
        echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].'Urbano: '.array_multisum($_SESSION['municipios']['quantidade']['Urbano']['0'][$_SESSION['filtro_relatorio_municipio']])."<br>";
        echo "Geral: de ".$_SESSION['filtro_relatorio_municipio'].'Rural: '.array_multisum($_SESSION['municipios']['quantidade']['Rural']['0'][$_SESSION['filtro_relatorio_municipio']])."<br>";
    }else{

        echo "Geral: ".array_multisum($_SESSION['municipios']['quantidade'])."<br>";
        $u = 0;
        $r = 0;
        foreach($_SESSION['municipios']['quantidade'] as $indice => $valores){
            $u += array_multisum($_SESSION['municipios']['quantidade'][$indice]['Urbano'])."<br>";
        }
        foreach($_SESSION['municipios']['quantidade'] as $indice => $valores){
            $r += array_multisum($_SESSION['municipios']['quantidade'][$indice]['Rural'])."<br>";
        }
        echo "Geral Urbano: ".$u."<br>";
        echo "Geral Rural: ".$r."<br>";


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