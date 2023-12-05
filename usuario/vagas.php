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
    <title>Vagas</title>
    
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/validacoes.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <link rel="stylesheet" href="../css/sidebar.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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
            $queryDados = "SELECT formulario_enviado_dados FROM usuario WHERE ID_USUARIO = $user_id"; 
            $resultadoD = mysqli_query($conn, $queryDados);
            $dadoQuery = mysqli_fetch_assoc($resultadoD);

            if($dadoQuery['formulario_enviado_dados'] == 1){

                $sql= "SELECT E.NOME AS ENOME, V.ID_VAGA AS VVAGA, V.TURNO AS VTURNO, V.TURNO_DAS AS VTURNO_DAS, V.TURNO_ATE AS VTURNO_ATE, 
                            V.SALARIO AS VSALARIO, V.CIDADE AS VCIDADE, V.ESTADO AS VESTADO, V.TIPO_CONTRATO AS VTIPO_CONTRATO, 
                            V.REQUISITOS AS VREQUISITOS, V.DESCRICAO AS VDESCRICAO, V.NOME AS VNOME
                        FROM empresa AS E
                        INNER JOIN vagas AS V
                        ON V.ID_EMPRESA = E.ID_EMPRESA
                        WHERE V.ID_VAGA NOT IN (SELECT ID_VAGA FROM usuario_vagas WHERE ID_USUARIO = $user_id)";

                $result = $conn->query($sql);

                // Verifica se houve erro na consulta
                if (!$result) {
                    die("Erro na consulta: " . $conn->error);
                }
                if ($result->num_rows == 0) {

                    print ' <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
                                <a style="text-decoration:none;">Ainda <b>NÃO</b> existem vagas disponíveis!</a>
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
                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#detalheVagas'.$row['VVAGA'].'" aria-expanded="false" aria-controls="detalheVagas">
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
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-secondary" type="button" onclick="candidatoVaga('.$row['VVAGA'].')">
                                                        Candidatar-se
                                                    </button>
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
            }else{
                print ' <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
                        <a style="text-decoration:none;">Você ainda <b>NÃO</b> terminou seu <b>CADASTRO!!!</b> complete seu cadastro para visualizar novas vagas</a>
                    </div>';
            }
        ?>

        </div>
    </div>
</div>





         

       
    

<script src="../src/JS/swetalert2.js"></script>
<script src="../src/JS/processos.js"></script>
<script src="../src/JS/jquery-3.7.1.js"></script>
<script src="../src/JS/sidebar.js"></script>

</body>
</html>