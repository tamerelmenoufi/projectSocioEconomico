<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>
<h3>Relatório Geral</h3>
<?php

    // echo "Total: ".@array_multisum($_SESSION['municipios']['quantidade'])."<br><hr>";


    // $_SESSION['municipios']
    //          ['quantidade']
    //          [$d->cod_municipio]
    //          [$d->local]
    //          [$d->zona_urbana]
    //          [$d->cod_bairro]
    //          [$d->situacao]

    //VERIFICAR AS QUANTIDADE POR SITUAÇÃO
    $i = 0; $iu = 0; $iuc = 0; $ir = 0; //Inicidos
    $p = 0; $pu = 0; $puc = 0; $pr = 0; //Pendentes
    $c = 0; $cu = 0; $cuc = 0; $cr = 0; //Concluídos
    $n = 0; $nu = 0; $nuc = 0; $nr = 0; //Não Encontrados

    foreach($_SESSION['municipios']['quantidade'] as $indice => $valores){ //Lista os municipios
        foreach($valores as $indice1 => $valores1){ //Lista as zonas
            foreach($valores1 as $indice2 => $valores2){ //Lista as zonas urbanas
                foreach($valores2 as $indice3 => $valores3){ //Lista os Bairros
                    //Obter as quantidades por situacao
                    $i += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['i']);
                    $p += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['p']);
                    $c += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['c']);
                    $n += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['n']);

                    if($indice1 == 'Urbano'){
                    //Obter as quantidades por situacao por zona Urbana
                    $iu += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['i']);
                    $pu += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['p']);
                    $cu += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['c']);
                    $nu += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['n']);

                    $iuz[$indice2] += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['i']);
                    $puz[$indice2] += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['p']);
                    $cuz[$indice2] += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['c']);
                    $nuz[$indice2] += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['n']);

                    }

                    if($indice1 == 'Rural'){
                    //Obter as quantidades por situacao por zona Rural
                    $ir += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['i']);
                    $pr += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['p']);
                    $cr += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['c']);
                    $nr += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['n']);
                    }

                    ///////////CONDIÇÔES PARA A CAPITAL - CODIGO 66 ////////////////////////
                    if($indice == 66){

                        $iuc += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['i']);
                        $puc += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['p']);
                        $cuc += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['c']);
                        $nuc += ($_SESSION['municipios']['quantidade'][$indice][$indice1][$indice2][$indice3]['n']);

                    }




                }
            }
        }
    }

    // echo "Geral Iniciados: ".$i."<br>";
    // echo "Geral Pendentes: ".$p."<br>";
    // echo "Geral Concluídos: ".$c."<br>";
    // echo "Geral Não Encontrados: ".$n."<br><hr>";

    // echo "Geral Urbano Iniciados: ".$iu."<br>";
    // echo "Geral Urbano Pendentes: ".$pu."<br>";
    // echo "Geral Urbano Concluídos: ".$cu."<br>";
    // echo "Geral Urbano Não Encontrados: ".$nu."<br><hr>";

    // echo "Geral Rural Iniciados: ".$ir."<br>";
    // echo "Geral Rural Pendentes: ".$pr."<br>";
    // echo "Geral Rural Concluídos: ".$cr."<br>";
    // echo "Geral Rural Não Encontrados: ".$nr."<br><hr>";

    // VERIFICANDO AS QUANTIDADE URBANOS E RURAIS
    $u = 0;
    $r = 0;
    foreach($_SESSION['municipios']['quantidade'] as $indice => $valores){
        $u += @array_multisum($_SESSION['municipios']['quantidade'][$indice]['Urbano']);
        $r += @array_multisum($_SESSION['municipios']['quantidade'][$indice]['Rural']);
    }
    // echo "Geral Urbano: ".$u."<br>";
    // echo "Geral Rural: ".$r."<br><hr>";

//////////////////////////////////////////////////////////////////////////////////////////
///////////CONDIÇÔES PARA A CAPITAL - CODIGO 66 ////////////////////////

$total_capital_urbano = @array_multisum($_SESSION['municipios']['quantidade'][66]['Urbano']);
$total_capital_rural = @array_multisum($_SESSION['municipios']['quantidade'][66]['Rural']);

// echo "Total Urbano na Capital:".$total_capital_urbano."<br>";
// echo "Total Rural na Capital:".$total_capital_rural."<br><hr>";

// echo "Geral Urbano na capital Iniciados: ".$iuc."<br>";
// echo "Geral Urbano na capital Pendentes: ".$puc."<br>";
// echo "Geral Urbano na capital Concluídos: ".$cuc."<br>";
// echo "Geral Urbano na capital Não Encontrados: ".$nuc."<br><hr>";

foreach($iuz as $ind => $val){
    // echo "<h5>{$ind}</h5>";
    // echo "Iniciados: ".$iuz[$ind]."<br>";
    // echo "Pendentes: ".$puz[$ind]."<br>";
    // echo "Concluídos: ".$cuz[$ind]."<br>";
    // echo "Não Encontrados: ".$nuz[$ind]."<br><hr>";
}
?>
<style>
    .AreaDashboard{
        position:absolute;
        left:20px;
        right:20px;
    }
    .cartao{
        position:relative;
        width:95%;
        height:95%;
        background-color:#ccc;
    }
</style>
<div class="AreaDashboard">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <div class="cartao">
                <span>Título do bloco</span>
                <p>78546</p>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>