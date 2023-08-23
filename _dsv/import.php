<?php

    $dados = file_get_contents("banco.csv");

    $linhas = explode("\n", $dados);

    echo "<table border='1'>";
    foreach($linhas as $i => $col){
        set_time_limit(90);
        $cols = explode(";", $linhas[$i]);
        echo "<tr>";
        foreach($cols as $j => $dado){
            set_time_limit(90);
            echo "<td>";
            echo $dado;
            echo "</td>";
        }
        echo "</tr>";
    }
    

    echo "</table>";