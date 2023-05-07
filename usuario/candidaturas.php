<?php 
session_start();

    if(empty($_SESSION)){
        header("Location: ../../index.php");
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
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/layout.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <script src="../../src/JS/jquery-3.6.4.js"></script>
</head>
<body>
<header>
    <h1 style="text-align: center; color:white; font-family: Ubuntu;">JOB'STAGE</h1>
</header>

<div class="sec-dados">
    
    <div class="navegacao">
        <nav class="navbarP">
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="./dados-usuario/cadastroUser.php">Dados</a></li>
            <li><a href="vagas.php">Vagas</a></li>
            <li><a href="candidaturas.php">Candidaturas</a></li>
            <li><a href="./dados-usuario/curriculo.html">Currículo</a></li>
            <li style="background-color: red;"> <a href="../src/configs/logout.php">Sair</a></li>
        </ul>
    </div>

    <div class="container-dados">
        <h1>Candidaturas</h1>
    </div>
    
    
</div>













<div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                        <h5 class="card-title">NOME DA EMPRESA</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                <ul>
                                    <li>Setor:{informação do banco}</li>
                                    <li>Turno:{informação do banco}</li>
                                    <li>Bairro:{informação do banco}</li>
                                    <li>Bolsa:{informação do banco}</li>
                                    <li>beneficio:VT/VR/VA/Home-Office/Hibrido/Day Off</li>
                                </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#aaa" aria-expanded="false" aria-controls="aaa">
                                </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="collapse" id="aaa">
                                        <div class="content-vagas">
                                            <div class="descricao">
                                                <div class="titulo-descricao">
                                                    
                                                </div>
                                                <div class="descricao-conteudo">
                                                </div>
                                            </div>
                                            <div class="requisitos">
                                                <div class="titulo-requisitos">
                                                </div>
                                                <div class="requisitos-conteudo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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