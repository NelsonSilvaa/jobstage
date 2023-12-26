<?php
session_start();

    if(empty($_SESSION)){
        header("Location: ../index.html");
    }
    include("../src/configs/conexao.php");

    $empresa_id = $_SESSION['ID_EMPRESA'];

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home empresas</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/validacoes.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>


    
<div class="main-container d-flex">
    <?php require_once "../src/template/empresa/sidebar.html" ?>
    
    <div class="content">
        <?php require_once "../src/template/empresa/navbar.html" ?>

        <div class="container">
            
            


        </div>
    </div>
   
</div>


    <script src="../src/JS/jquery-3.7.1.js"></script>
    <script src="../src/JS/swetalert2.js"></script>
    <script src="../src/JS/sidebar.js"></script>
</body>
</html>