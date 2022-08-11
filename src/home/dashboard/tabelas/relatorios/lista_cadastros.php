<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
    // iniciados pendentes concluidos nao_encontrados
    switch($_GET['opc']){
        case 'iniciados':{
            $where = "and percentual > '0'";
            break;
        }
        case 'pendentes':{
            $where = "and percentual > '0' and percentual < 100";
            break;
        }
        case 'concluidos':{
            $where = "and percentual = '100'";
            break;
        }
        case 'nao_encontrados':{
            $where = "and beneficiario_encontrado = 'Não'";
            break;
        }
        default:{
            $where = false;
        }

    }

    if(!$where) exit();
?>
<table class="table table-hover">

<thead>
    <tr>
        <th>Nome</th>
        <th>CPF</th>
    </tr>
</thead>
<tbody>
<?php
    $query = "select * from se where 1 {$where} limit 100";
    $result = mysqli_query($con, $query);
    while($d = mysqli_fetch_object($result)){
?>
    <tr>
        <td><?=$d->nome?></td>
        <td><?=$d->cpf?></td>
    </tr>
<?php
    }
?>
</tbody>
</table>