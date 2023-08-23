<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
    $con = AppConnect('se');

    $dados = file_get_contents("banco.csv");

    $linhas = explode("\n", $dados);

    // echo "<table border='1'>";
    foreach($linhas as $i => $col){

        if($i == 0){
            $cols = explode(";", $linhas[$i]);
            $Campos = [];
            foreach($cols as $j => $dado){
                $Campos[] = "`campo1{$j}` VARCHAR(255) NOT NULL";
            }   
            echo $camando = "CREATE TABLE IF NOT EXISTS `se`.`tratar` ( ".implode(", ", $Campos)." )";
            mysqli_query($con, $comando);   
            echo "<hr>";    

        }else{
            $Dado = [];
            $cols = explode(";", $linhas[$i]);
            foreach($cols as $j => $dado){
                set_time_limit(90);
                $Dado[] = "'{$dado}'";
            } 
            echo $camando = "INSERT INTO `se`.`tratar` ( ".implode(", ", $Dado)." )";
            mysqli_query($con, $comando);
            echo "<hr>";    

        }
        set_time_limit(90);
        $cols = explode(";", $linhas[$i]);
        // echo "<tr>";
        // foreach($cols as $j => $dado){
        //     set_time_limit(90);
        //     echo "<td>";
        //     echo $dado;
        //     echo "</td>";
        // }
        // echo "</tr>";
        if($i = 5) exit();
    }

    

    // echo "</table>";