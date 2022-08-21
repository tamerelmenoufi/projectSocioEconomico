<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
    $md5 = md5($_POST['rotulo'].$md5);
?>


<canvas id="Tipos<?= $md5 ?>" width="400" height="400"></canvas>
<ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      Cras justo odio
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      Cras justo odio
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      Cras justo odio
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
</ol>

<?php

    // VERIFICANDO AS QUANTIDADE URBANOS E RURAIS
    $u = 0;
    $r = 0;
    foreach($_SESSION['municipios']['quantidade'] as $indice => $valores){
        $u += @array_multisum($_SESSION['municipios']['quantidade'][$indice]['Urbano']);
        $r += @array_multisum($_SESSION['municipios']['quantidade'][$indice]['Rural']);
    }
    // echo "Geral Urbano: ".$u."<br>";
    // echo "Geral Rural: ".$r."<br><hr>";

    $Rotulos = ['Urbano','Rural'];
    $Quantidade = [$u, $r];
    $R = (($Rotulos)?"'".implode("','",$Rotulos)."'":0);
    $Q = (($Quantidade)?implode(",",$Quantidade):0);

?>
<script>
    const TiposCtx<?=$md5?> = document.getElementById('Tipos<?=$md5?>');

    const Tipos<?=$md5?> = new Chart(TiposCtx<?=$md5?>,
        {
            type: 'pie',
            data: {
                labels: [<?=$R?>],
                datasets: [{
                    label: [<?=$R?>],
                    data: [<?=$Q?>],
                    backgroundColor: [
                        'rgb(75, 192, 192, 0.2)',
                        'rgb(255, 159, 64, 0.2)',
                        'rgb(255, 99, 132, 0.2)',
                                            ],
                    borderColor: [
                        'rgb(75, 192, 192, 1)',
                        'rgb(255, 159, 64, 1)',
                        'rgb(255, 99, 132, 1)',
                    ],
                    borderWidth: 1,
                    rotulos: [<?=$R?>]
                }]
            },
            options:{
                plugins: {
                    legend: {
                        display: false,
                    }
                }
            }
        }
    );



</script>