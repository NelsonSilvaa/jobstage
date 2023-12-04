<?php 
session_start();

    if(empty($_SESSION)){
        header("Location: ./acesso/login-usuario.html");
    }
    include("../src/configs/conexao.php");

    $user_id = $_SESSION['ID_USUARIO'];

?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <script src="../../src/JS/jquery-3.6.4.js"></script>
    <script src="../../src/JS/sidebar.js"></script>
</head>
<body>
<header>
    <h1 style="text-align: center; color:white; font-family: Ubuntu;">JOB'STAGE</h1>
</header>


<div class="main-container d-flex">
    <?php require_once "../src/template/usuario/sidebar.html" ?>
    
    <div class="content">
        <?php require_once "../src/template/usuario/navbar.html" ?>
        <div class="dashboard-content px-3 pt-4">
            <h1>SEJA BEM VINDO A JOBSTAGE!!!</h1>
            <p>complete seu perfil na aba de dados para poder visualizar novas vagas de estágio!</p>
        </div>

    </div>
</div>




    <script 
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-kSpN/7CfdBjN9+RY5DhN5Hz5zr+ZnysK8W1ufX0ZN0SPR20BpZiDgmWwfdKvSGtl"
        crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>