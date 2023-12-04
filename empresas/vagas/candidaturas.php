<?php
session_start();

    if(empty($_SESSION)){
        header("Location: ../index.html");
    }
    include("../../src/configs/conexao.php");

    $empresa_id = $_SESSION['ID_EMPRESA'];

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidaturas</title>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/layout.css">
    <link rel="stylesheet" href="../../css/sweetalert2.css">
    <link rel="stylesheet" href="../../css/validacoes.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <h1 style="text-align: center; color:white; font-family: Ubuntu;">JOB'STAGE</h1>
</header>

<div class="sec-dados">
    
    <div class="navegacao">
        <nav class="navbarP">
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="cadastro-vagas.php"> Nova vaga</a></li>
                <li><a href="editar-vagas.php"> Editar vagas</a></li>
                <li><a href="candidaturas.php">Candidaturas</a></li>
                <li style="background-color: red;"> <a href="../../src/configs/logout.php">Sair</a></li>
            </ul>
        </nav>
    </div>
</div>
<div class="container container-vagas">


<?php

    $resultado = mysqli_query($conn, "SELECT V.NOME AS VNOME, U.NOME AS UNOME, U.ID_USUARIO AS UID FROM empresa AS E
    INNER JOIN vagas AS V ON E.ID_EMPRESA = V.ID_EMPRESA
    INNER JOIN usuario_vagas UV ON UV.ID_VAGA = V.ID_VAGA
    INNER JOIN usuario as U ON UV.ID_USUARIO = U.ID_USUARIO
    WHERE E.ID_EMPRESA = $empresa_id");

    $vagas_unicas = array();

    // Itere sobre o resultado da consulta SQL
    while ($row = mysqli_fetch_array($resultado)) {
    // Crie uma chave única para cada vaga com base no nome da vaga
    $chave = $row['VNOME'];

    // Adicione a vaga ao array de vagas únicas se ela ainda não estiver presente
    if (!array_key_exists($chave, $vagas_unicas)) {
        $vagas_unicas[$chave] = array(
            'nome_vaga' => $row['VNOME'],
            'nomes_usuarios' => array()
        );
    }

    // Adicione o nome do usuário ao array de nomes de usuário para esta vaga
    $vagas_unicas[$chave]['nomes_usuarios'][] = array('nome' => $row['UNOME'], 'id' => $row['UID']);
    }

    // Itere sobre o array de vagas únicas para exibir os resultados
    $idModal = 1;
    foreach ($vagas_unicas as $vaga) {
        print '<div class="" data-id= data-row-id=>

                    <div class="card-vaga">
                        <div class="card-titulo">
                            <h2>'.$vaga['nome_vaga'].'</2>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCandidatos'.$idModal.'">
                            Ver candidaturas
                        </button> 
                    </div>
                </div>
                <br><br><br>';

    // Exiba os nomes dos usuários que se candidataram a esta vaga

        print ' <div class="modal fade" id="modalCandidatos'.$idModal.'" tabindex="-1" role="dialog" aria-labelledby="modalCandidatos'.$idModal.'" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>CANDIDATURAS</h5>
                        </div>
                        <div class="modal-body">
                        <table class="table table-striped" style="margin: 0 auto">
                        <tr>
                        <td><b>#</b></td>
                        <td><b>Nome</b></td>
                        <td><b>Curriculo</b></td>
                        </tr>';
                        $id_count = 1;
                            foreach ($vaga['nomes_usuarios'] as $usuario) {
                                print' 
                                    <tr>
                                        <td>'.$id_count.'</td>
                                        <td> '.$usuario['nome'] .'</td>
                                        <td><a href="curriculoUsuarios.php?id_usuario='.$usuario['id'].'" target="_blank">Currículo</a></td>   
                                    </tr> ';
                                $id_count += 1;
                            }
                print  '</table>
                </div>
                    </div>
                    </div>
                </div>';

        $idModal += 1;
    }
?>
</div>









    <script src="../../src/JS/jquery-3.7.1.js"></script>
    <script src="../../src/JS/processos.js"></script>
    <script src="../../src/JS/swetalert2.js"></script>
    <script src="../src/JS/sidebar.js"></script>
</body>
</html>