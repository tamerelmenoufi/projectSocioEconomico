<?php

    $con = mysqli_connect("project.mohatron.com","root","SenhaDoBanco", "manutencao");
    $dados = file_get_contents("lista4.csv");

    function M($d){
        global $con;

        $q = "select * from municipios where descricao = '{$d}'";
        $r = mysqli_query($con, $q);
        if(mysqli_num_rows($r)){

        }

    }

    $l = explode("\n",$dados);
    // echo "<table border='1'>";
    $comando = [];

    $start = "INSERT INTO se (
        municipio,
        CPF,
        nome,
        nascimento,
        Identidade,
        endereco,
        localidade,
        tipo,
        telefone
    ) VALUES ";

    for($i=0;$i<count($l);$i++){
        set_time_limit(90);
        // echo "
        //     <tr>";

        $c = explode(":", $l[$i]);
        $campos = [];
        for($k=0;$k<count($c);$k++){

            // echo "<td>{$c[$k]}</td>";
            $campos[] = "{$c[$k]}";

        }

        $comando[] = "('".implode("','", $campos)."')";

        // echo "</tr>
        // ";
        if($i%100 == 0 and $i > 0) {
            $query =  $start.implode(", ",$comando);
            if(mysqli_query($con, $query)){
                echo "ok<hr>";
            }else{
                echo $query."<hr>";
            }
            $quey = false;
            $comando = [];

        }
        if($i === 300) {
            //break;
        }
    }


        $query =  $start.implode(", ",$comando);
        if(mysqli_query($con, $query)){
            echo "ok<hr>";
        }else{
            echo $query."<hr>";
        }
        $quey = false;
        $comando = [];

    // echo "</table>";

    // insert into `municipios` (municipio) select municipio from se group by municipio order by municipio
    // insert into `bairros_comunidades` (municipio, descricao, tipo) select municipio_cod, localidade, tipo from se group by municipio, localidade, tipo


    // update se a set a.municipio_cod = (select codigo from municipios where a.municipio = municipio)
    // update se a set localidade_cod = (select codigo from bairros_comunidades where a.municipio_cod = municipio and a.localidade = descricao and a.tipo = tipo)