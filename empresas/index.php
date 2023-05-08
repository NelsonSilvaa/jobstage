<?php
session_start();

    if(empty($_SESSION)){
        header("Location: ../index.html");
    }
    include("../src/configs/conexao.php");

    $empresa_id = $_SESSION['ID_EMPRESA'];

    die($empresa_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    LOGIN EMPRESA
</body>
</html>