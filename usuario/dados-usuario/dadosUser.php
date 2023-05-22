<?php 
session_start();

    if(empty($_SESSION)){
        header("Location: ../../index.html");
    }
    include("../../src/configs/conexao.php");

$user_id = $_SESSION['ID_USUARIO'];

    $sql_formacao = "SELECT  COUNT(*) as total FROM formacao WHERE ID_USUARIO = $user_id";
    $sql_experiencia = "SELECT COUNT(*) as total FROM experiencia WHERE ID_USUARIO = $user_id";
    $sql_cursos = "SELECT COUNT(*) as total FROM curso_extra WHERE ID_USUARIO = $user_id";

    $resultado_F = mysqli_query($conn, $sql_formacao);
    $resultado_E = mysqli_query($conn, $sql_experiencia);
    $resultado_C = mysqli_query($conn, $sql_cursos);


    $total_F = mysqli_fetch_assoc($resultado_F);
    // $total_registros_F = $resultado_F['total'];

    $total_E = mysqli_fetch_assoc($resultado_E);
    // $total_registros_E = $total_registros_E['total'];

    $total_C = mysqli_fetch_assoc($resultado_C);
    // $total_registros_C = $total_registros_C['total'];


    // pesquisas SQL
    $queryDados = "SELECT * FROM usuario WHERE ID_USUARIO = $user_id"; 
    $resultadoD = mysqli_query($conn, $queryDados);
    $dadoQuery = mysqli_fetch_assoc($resultadoD);


    $queryEscolaridade = "SELECT * FROM escolaridade WHERE ID_USUARIO = $user_id"; 
    $resultadoE = mysqli_query($conn, $queryEscolaridade);
    $escQuery = mysqli_fetch_assoc($resultadoE);

    

?>


<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados pessoais</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/layout.css">
    <link rel="stylesheet" href="../../css/sweetalert2.css">
    <link rel="stylesheet" href="../../css/validacoes.css">
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
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="dadosUser.php">Dados</a></li>
            <li><a href="../vagas.php">Vagas</a></li>
            <li><a href="../candidaturas.php">Candidaturas</a></li>
            <li><a href="curriculo.php">Currículo</a></li>
            <li style="background-color: red;"> <a href="../../src/configs/logout.php">Sair</a></li>
        </ul>
    </div>


    <div class="container-dados">
        <nav class="nav nav-pills flex-column flex-sm-row card">
            <a id="dados-link" class="flex-sm-fill text-sm-center nav-link" href="dadosUser.php">Dados</a>
            <a id="formacao-link" class="flex-sm-fill text-sm-center nav-link" href="formacaoUser.php">Formação</a>
            <a id="exp-link" class="flex-sm-fill text-sm-center nav-link" href="expUser.php">Experiência</a>
            <a id="curso-link" class="flex-sm-fill text-sm-center nav-link" href="cursoUser.php">Cursos</a>
        </nav>
        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
            <!-- DADOS -->
                    <div class="" id="dados" >
                        <form >
                            <div class="form-row">
                                <div class="col">
                                    <label for="Nome">Nome Completo <span style="color: red;">*</span> </label>
                                    <input type="text" class="form-control" value="<?php echo isset($dadoQuery['NOME']) ? $dadoQuery['NOME']: '' ?>" name="nome" id="nome" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                    <span id="nome-error" style="display:none; color:red;">Campo obrigatório!</span>
                                </div>
                                <div class="col">
                                    <label for="email">Email<span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" value="<?php echo isset($dadoQuery['EMAIL']) ? $dadoQuery['EMAIL']: '' ?>" name="email" id="email" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                    <span id="email-error" style="display:none; color:red;">Campo obrigatório!</span>

                                </div>
                            </div>
                    
                            <div class="form-row">
                                <div class="col">
                                    <label for="dataNsc">Data Nasc.<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" value="<?php echo isset($dadoQuery['DATA_NASC']) ? $dadoQuery['DATA_NASC']: '' ?>" name="dataNsc" id="dataNsc" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                    <span id="dataNsc-error" style="display:none; color:red;">Campo obrigatório!</span>

                                </div>
                                <div class="col">
                                    <label for="estadoCivil">Estado Civil<span style="color: red;">*</span></label>
                                    <select type="text" class="form-control" name="estadoCivil" id="estadoCivil" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'?> required>
                                        <option value=""></option>
                                        <option value="Solteiro(a)" <?php echo (isset($dadoQuery['ESTADO_CIVIL']) ? ($dadoQuery['ESTADO_CIVIL'] == "Solteiro(a)" ? "Selected":''): '') ?>>Solteiro(a)</option>
                                        <option value="Casado(a)" <?php echo (isset($dadoQuery['ESTADO_CIVIL']) ? ($dadoQuery['ESTADO_CIVIL'] == "Casado(a)" ? "Selected":''): '') ?>>Casado(a)</option>
                                        <option value="Divorciado(a)" <?php echo (isset($dadoQuery['ESTADO_CIVIL']) ? ($dadoQuery['ESTADO_CIVIL'] == "Divorciado(a)" ? "Selected":''): '') ?>>Divorciado(a)</option>
                                    </select>
                                    <span id="estadoCivil-error" style="display:none; color:red;">Campo obrigatório!</span>

                                </div>
                                <div class="col">
                                    <label for="telefone">Telefone<span style="color: red;">*</span></label>
                                    <input type="number" class="form-control" value="<?php echo isset($dadoQuery['TELEFONE']) ? $dadoQuery['TELEFONE']: '' ?>" name="telefone" id="telefone" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                    <span id="telefone-error" style="display:none; color:red;">Campo obrigatório!</span>
                                </div>
                            </div>
                    
                            
                            <div class="form-row">
                                <div class="col">
                                    <label for="linkedin">LinkedIn<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="Coloque o link do seu LinkedIn aqui" value="<?php echo isset($dadoQuery['LINKEDIN']) ? $dadoQuery['LINKEDIN']: '' ?>"  name="linkedin" id="linkedin" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'?> >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <!-- <div class="alert alert-info" role="alert"  style="width:100%;">
                                        <a style="text-decoration:none;" class="alert-link">Aproveite para falar sobre você, experiências profissionais e objetivos de vida!</a>
                                    </div> -->
                                    <label for="objetivo">Sobre<span style="color: red;">*</span></label>
                                    <textarea type="text" class="form-control" placeholder="Fale sobre você, suas expências, habilidades e objetivos" name="objetivo" id="objetivo" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'?>> <?php echo isset($dadoQuery['SOBRE']) ? $dadoQuery['SOBRE']: '' ?></textarea>
                                </div>
                            </div>
                        <div style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar" onclick="criarDados()">Salvar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

    <script src="../../src/JS/app.js"></script>
    <script src="../../src/JS/processos.js"></script>
    <script src="../../src/JS/swetalert2.js"></script>
    <script src="../../src/JS/jquery-3.6.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-kSpN/7CfdBjN9+RY5DhN5Hz5zr+ZnysK8W1ufX0ZN0SPR20BpZiDgmWwfdKvSGtl" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>