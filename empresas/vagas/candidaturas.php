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
    <title>Candidaturas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/validacoes.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<header>
    <h1 style="text-align: center; color:white; font-family: Ubuntu;">JOB'STAGE</h1>
</header>

<div class="sec-dados">
    
    <div class="navegacao">
        <nav class="navbarP">
        <ul>
        <ul>
        <li><a href="../index.php">Inicio</a></li>
          <!-- <li><a href="cadastroUser.php">Dados</a></li> -->
          <li><a href="#">Vagas</a></li>
          <li><a href="cadastro-vagas.php">> Nova vaga</a></li>
          <li><a href="editar-vagas.php">> Editar vagas</a></li>
          <li><a href="candidaturas.php">Candidaturas</a></li>
          <!-- <li><a href="curriculo.php">Funcionários</a></li> -->
          <li style="background-color: red;"> <a href="../../src/configs/logout.php">Sair</a></li>
      </ul>
        </ul>
    </div>

    <div class="container-dados">
        <h1>SEJA BEM VINDO A JOBSTAGE!!!</h1>
        <p>complete seu perfil na aba de dados para poder visualizar novas vagas de estágio!</p>
    </div>
    
    
</div>


    <script src="../src/JS/jquery-3.6.4.js"></script>
    <script src="../src/JS/swetalert2.js"></script>
    <script 
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-kSpN/7CfdBjN9+RY5DhN5Hz5zr+ZnysK8W1ufX0ZN0SPR20BpZiDgmWwfdKvSGtl"
        crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>