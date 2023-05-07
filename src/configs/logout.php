<?php
    session_start();
    unset($_SESSION["ID_USUARIO"]);
    session_destroy();
    header("Location: ../../index.html");
    exit;
?>