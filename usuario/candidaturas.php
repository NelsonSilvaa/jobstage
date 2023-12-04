<?php 
session_start();

    if(empty($_SESSION)){
        header("Location: ../../index.php");
    }
    include("../src/configs/conexao.php");

    $user_id = $_SESSION['ID_USUARIO'];

    $sql= "SELECT E.NOME AS ENOME, V.ID_VAGA AS VVAGA, V.TURNO AS VTURNO, V.TURNO_DAS AS VTURNO_DAS, V.TURNO_ATE AS VTURNO_ATE, 
                  V.SALARIO AS VSALARIO, V.CIDADE AS VCIDADE, V.ESTADO AS VESTADO, V.TIPO_CONTRATO AS VTIPO_CONTRATO, 
                  V.REQUISITOS AS VREQUISITOS, V.DESCRICAO AS VDESCRICAO, V.NOME AS VNOME
            FROM empresa AS E
            INNER JOIN vagas AS V
            ON V.ID_EMPRESA = E.ID_EMPRESA
            WHERE V.ID_VAGA IN (SELECT ID_VAGA FROM usuario_vagas WHERE ID_USUARIO = $user_id)";

    $result = $conn->query($sql);

    // Verifica se houve erro na consulta
    if (!$result) {
        die("Erro na consulta: " . $conn->error);
    }

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
    <script src="../src/JS/jquery-3.6.4.js"></script>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="../src/JS/sidebar.js"></script>
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
            <?php
                if ($result->num_rows == 0) {
                    print ' <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
                                <a style="text-decoration:none;">Você ainda <b>NÃO</b> se candidatou em <b>NENHUMA</b> vaga!</a>
                            </div>';
                }else{    
                    // Percorre os resultados da consulta
                    $id_table = 1;
                    while ($row = $result->fetch_assoc()) {
                    print ' <div class="" data-id='.$id_table.' data-row-id='.$row['VVAGA'].'>
                                <div class="card-vaga">
                                    <div class="card-titulo">
                                        <h2>'.$row['VNOME'].'</2>
                                    </div>
                                    
                                    <div class="titulo-conteudo-prev">
                                        <h3>'.$row['ENOME'].'</h3>
                                    </div>
                                    <div class="card-conteudo-prev">
                                        <div class="cidade">
                                            '.$row['VCIDADE'].' -
                                        </div>
                                        <div class="turno">
                                            <div class="turnoPeriodo">
                                                '.$row['VTURNO'].' 
                                            </div>
                                            <div class="tDas">
                                                :'.$row['VTURNO_DAS'].'
                                            </div>
                                            <div class="tAte">
                                            -'.$row['VTURNO_ATE'].'
                                            </div>
                                        </div>
                                        <div class="tipo-Contrato">
                                            - '.$row['VTIPO_CONTRATO'].'
                                        </div>
                                    </div>
                                    <div class="card-conteudo-prev_down">
                                        <div class="salario">
                                            R$ '.$row['VSALARIO'].'
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#detalheVagas'.$row['VVAGA'].'" aria-expanded="false" aria-controls="detalheVagas">
                                                Detalhes
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="collapse" id="detalheVagas'.$row['VVAGA'].'">
                                                <div class="content-vagas">
                                                    <div class="descricao">
                                                        <div class="card-titulo titulo-descricao">
                                                            <h4>DESCRIÇÃO</h4>
                                                        </div>
                                                        <div class="descricao-conteudo">
                                                        '.$row['VDESCRICAO'].'
                                                        </div>
                                                    </div>
                                                    <div class="requisitos">
                                                        <div class="card-titulo titulo-requisitos">
                                                            <h4>REQUISITOS</h4>
                                                        </div>
                                                        <div class="requisitos-conteudo">
                                                        '.$row['VREQUISITOS'].'
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        <br><br><br>';
                    }
                $conn->close();
                }
            ?>
        </div>
    </div>
</div>

<script src="../src/JS/swetalert2.js"></script>
<script src="../src/JS/processos.js"></script>
<script src="../src/JS/jquery-3.6.4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-kSpN/7CfdBjN9+RY5DhN5Hz5zr+ZnysK8W1ufX0ZN0SPR20BpZiDgmWwfdKvSGtl" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>