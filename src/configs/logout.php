<?php
    session_start();
    if ($_SESSION['ID_USUARIO']){
        unset($_SESSION["ID_USUARIO"]);
        session_destroy();
        header("Location: ../../index.html");
    exit; 
    }else{
        unset($_SESSION["ID_EMPRESA"]);
        session_destroy();
        header("Location: ../../index.html");
    }
    
?>