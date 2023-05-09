<?php 
// session_start();

//     if(empty($_SESSION)){
//         header("Location: ../../index.php");
//     }
//     include("../src/configs/conexao.php");

//     $user_id = $_SESSION['ID_USUARIO'];
//   $sqlvagas = "SELECT COUNT(*) as total FROM empresa WHERE ID_EMPRESA = $empresa_id";

//   $resultado = mysqli_query($conn, $sql_experiencia);

//   $total = mysqli_fetch_assoc($resultado);


//   $query = "SELECT * FROM vagas WHERE ID_EMPRESA = $empresa_id AND ID_VAGA =  $row->ID_VAGA"; 
//   $resultadoVagas = mysqli_query($conn, $query);
//   $expQuery = mysqli_fetch_assoc($resultadoVagas);
// ?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/layout.css">
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
          <li><a href="../index.html">Inicio</a></li>
          <!-- <li><a href="cadastroUser.php">Dados</a></li> -->
          <li><a href="#">Vagas</a></li>
          <li><a href="cadastro-vagas.php">> Nova vaga</a></li>
          <li><a href="editar-vagas.php">> Editar vagas</a></li>
          <li><a href="../candidaturas.php">Candidaturas</a></li>
          <!-- <li><a href="curriculo.php">Funcionários</a></li> -->
          <li style="background-color: red;"> <a href="../../src/configs/logout.php">Sair</a></li>
      </ul>
  </div>

    <div class="container-dados">
        <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
            <a style="text-decoration:none;"><b>EDITAR VAGAS</b></a>
        </div>
        <div class="card">
            <div class="card-header">
                NOME DA VAGA
            </div>
            <div class="conteudo-vaga">
                <div class="info-vaga">
                    <p>Curitiba - PR - CLT</p>
                    <p>R$ 1.000,00</p>
                </div>
                <div class="titulo-descricao-vaga">
                    <h3>DESCRIÇÃO</h3>
                </div>
                <div class="conteudo-descricao-vaga">
                    <p>
                        aaaaaaaaaaaaaaaaaaaaaaaaa
                    </p>
                </div>
                <div class="botao-editar-remover" style="display:flex; flex-direction:row; justify-content:space-around; width:100%;">
                    <div class="edit">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter'.$id_table.'">EDITAR</button> 
                    </div>
                    <div class="delete">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletarModal'.$id_table.'">REMOVER</button>
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
    <script src="../../src/JS/jquery-3.6.4.js"></script>
</body>
</html>