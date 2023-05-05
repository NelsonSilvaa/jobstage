<?php
    session_start();
    unset($_SESSION["ID_USUARIO"]);
    unset($_SESSION['usuario']);
    session_destroy();
    header("Location: ../../indexlogin.php");
    exit;
?>