<?php
    session_start();
    include("/appinc/connect.php");
    $con = AppConnect('app');
    $md5 = md5(date("YmdHis"));