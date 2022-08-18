<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>
<h3>Relatório Geral</h3>
<?php

    echo "Total: ".array_multisum($_SESSION['municipios']['quantidade'])."<br>";




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