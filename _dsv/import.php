<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
    $con = AppConnect('se');

    $del = [' ', '-','.','/','\\'];

    $dados = file_get_contents("banco.csv");

    $linhas = explode("\n", $dados);

    $I = (($_GET['i'])?:0);
    $p = 50;

    // echo "<table border='1'>";
    for($i = $I; $i < count($linhas); $i++){

        if($i == 0){
            $cols = explode(";", $linhas[$i]);
            $Campos = [];
            $Campos[] = "`codigo` BIGINT AUTO_INCREMENT PRIMARY KEY";
            foreach($cols as $j => $dado){
                $Campos[] = "`c".str_replace($del,'_',$dado)."` VARCHAR(255) NOT NULL";
            }   
            echo $comando = "CREATE TABLE IF NOT EXISTS `se`.`tratar` ( ".implode(", ", $Campos)." )";
            mysqli_query($con, $comando);   
            echo "<hr>";    

        }else{
            $Dado = [];
            $Dado[] = "'{$i}'";
            $cols = explode(";", $linhas[$i]);
            foreach($cols as $j => $dado){
                set_time_limit(90);
                $Dado[] = "'{$dado}'";
            } 
            echo $comando = "INSERT INTO `se`.`tratar` VALUES ( ".implode(", ", $Dado)." )";
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
        exit();
        if($i == ($I + $p)) {
            echo "<script>window.location.href='./import.php?i={$i}'</script>";
            exit();
        }
    }

    

    // echo "</table>";