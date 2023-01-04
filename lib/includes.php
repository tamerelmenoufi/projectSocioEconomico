<?php
    session_start();
    include("/appinc/cBarb.php");
    include("/appinc/connect.php");
    include("fn.php");
    $con = AppConnect('app');
    $md5 = md5(date("YmdHis"));