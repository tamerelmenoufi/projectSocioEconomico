<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>
<h3>Relatório Geral</h3>
<?php

    echo "Total: ".array_multisum($_SESSION['municipios']['quantidade'])."<br>";


    // $_SESSION['municipios']['quantidade'][$d->cod_municipio][$d->local][$d->zona_urbana][$d->cod_bairro][$d->situacao] = $d->quantidade;

    //VERIFICAR AS QUANTIDADE POR SITUAÇÃO
    $i = 0; //Inicidos
    $p = 0; //Pendentes
    $c = 0; //Concluídos
    $n = 0; //Não Encontrados
    foreach($_SESSION['municipios']['quantidade'] as $indice => $valores){ //Lista os municipios
        foreach($valores as $indice1 => $valores1){ //Lista as zonas
            foreach($valores1 as $indice2 => $valores2){ //Lista as zonas urbanas
                foreach($valores2 as $indice3 => $valores3){ //Lista os Bairros
                    //Obter as quantidades por situacao
                    $i += @array_multisum($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['i']);
                    $p += @array_multisum($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['p']);
                    $c += @array_multisum($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['c']);
                    $n += @array_multisum($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['n']);
                }
            }
        }
    }
    echo "Geral Iniciados: ".$i."<br>";
    echo "Geral Pendentes: ".$p."<br>";
    echo "Geral Concluídos: ".$c."<br>";
    echo "Geral Não Encontrados: ".$n."<br>";

    // VERIFICANDO AS QUANTIDADE URBANOS E RURAIS
    $u = 0;
    $r = 0;
    foreach($_SESSION['municipios']['quantidade'] as $indice => $valores){

            $u += array_multisum($_SESSION['municipios']['quantidade'][$indice]['Urbano']);
        if($indice != 66){
            $r += array_multisum($_SESSION['municipios']['quantidade'][$indice]['Rural']);
        }
    }
    echo "Geral Urbano: ".$u."<br>";
    echo "Geral Rural: ".$r."<br>";