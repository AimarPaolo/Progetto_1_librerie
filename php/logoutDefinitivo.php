<?php
    include("aperturaSessioni.php");
    if(isset($_REQUEST["si"])){
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }elseif(isset($_REQUEST["no"])){
        header("Location: acquisto.php");
        exit();
    }  
?>