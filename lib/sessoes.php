<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if($_POST['session']){
        $session = json_decode(base64_decode($_POST['session']));
        if($session){
            foreach($session as $ind => $val){
                $_SESSION[$ind] = $val;
            }
        }
    }

    if(array_key_exists('ProjectSeLogin', $_SESSION)){
        echo base64_encode(json_encode($_SESSION)); 
    }else{
        echo '<script>window.location.href="./?s=1"</script>';
    }
