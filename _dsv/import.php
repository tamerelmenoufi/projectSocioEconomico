<?php

    $dados = file_get_contents("banco.csv");

    $linhas = explode("\n", $dados);

    echo "<table border='1'>";
    foreach($linhas as $i => $col){
        $cols = explode(";", $linhas[$i]);
        echo "<tr>";
        foreach($cols as $j => $dado){
            echo "<td>";
            echo $dado;
            echo "</td>";
        }
        echo "</tr>";
    }
    

    echo "</table>";