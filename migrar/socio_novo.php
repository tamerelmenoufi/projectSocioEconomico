<?php

    $con = mysqli_connect("project.mohatron.com","root","SenhaDoBanco", "app");
    
    $query = "select * from se limit 100";
    $result = mysqli_query($con, $query);
    while($d = mysqli_fetch_object($result)){
        echo $d->cpf."<br>";
    }