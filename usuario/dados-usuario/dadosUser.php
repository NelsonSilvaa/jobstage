<?php 
session_start();

    if(empty($_SESSION)){
        header("Location: ../../index.html");
    }
    include("../../src/configs/conexao.php");

$user_id = $_SESSION['ID_USUARIO'];

    // pesquisas SQL
    $queryDados = "SELECT * FROM usuario WHERE ID_USUARIO = $user_id"; 
    $resultadoD = mysqli_query($conn, $queryDados);
    $dadoQuery = mysqli_fetch_assoc($resultadoD);

?>


<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados pessoais</title>
    
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/layout.css">
    <link rel="stylesheet" href="../../css/sweetalert2.css">
    <link rel="stylesheet" href="../../css/validacoes.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    

</head>
<body>
<header>
    <h1 style="text-align: center; color:white; font-family: Ubuntu;">JOB'STAGE</h1>
</header>
<div class="main-container d-flex">
    <?php require_once "../../src/template/usuario/sidebar.html" ?>
    
    <div class="content">
        <?php require_once "../../src/template/usuario/navbar.html" ?>

        <div class="dashboard-content px-3 pt-4">
        <nav class="nav nav-pills flex-column flex-sm-row card">
            <a id="dados-link" class="flex-sm-fill text-sm-center nav-link"    <?php echo $dadoQuery['formulario_enviado_dados'] == 1? "href='dadosUser.php'":'disabled' ?>>Dados</a>
            <a id="formacao-link" class="flex-sm-fill text-sm-center nav-link" <?php echo $dadoQuery['formulario_enviado_dados'] == 1? "href='formacaoUser.php'":'disabled style="opacity: 0.5; cursor: default;"' ?>>Formação</a>
            <a id="exp-link" class="flex-sm-fill text-sm-center nav-link"      <?php echo $dadoQuery['formulario_enviado_dados'] == 1? "href='expUser.php'":'disabled style="opacity: 0.5; cursor: default;"' ?>>Experiência</a>
            <a id="curso-link" class="flex-sm-fill text-sm-center nav-link"    <?php echo $dadoQuery['formulario_enviado_dados'] == 1? "href='cursoUser.php'":'disabled style="opacity: 0.5; cursor: default;"' ?>>Cursos</a>
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
                                    <input type="text" class="form-control" value="<?php echo isset($dadoQuery['NOME']) ? $dadoQuery['NOME']: '' ?>" name="nome" id="nome" <?php echo $dadoQuery['formulario_enviado_dados'] == 1? 'disabled': ''; ?> required>
                                    <span id="nome-error" style="display:none; color:red;">Campo obrigatório!</span>
                                </div>
                                <div class="col">
                                    <label for="email">Email<span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" value="<?php echo isset($dadoQuery['EMAIL']) ? $dadoQuery['EMAIL']: '' ?>" name="email" id="email"  disabled>
                                    <span id="email-error" style="display:none; color:red;">Campo obrigatório!</span>

                                </div>
                            </div>
                    
                            <div class="form-row">
                                <div class="col">
                                    <label for="dataNsc">Data Nasc.<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" value="<?php echo isset($dadoQuery['DATA_NASC']) ? $dadoQuery['DATA_NASC']: '' ?>" name="dataNsc" id="dataNsc" <?php echo $dadoQuery['formulario_enviado_dados'] == 1? 'disabled': ''; ?> required>
                                    <span id="dataNsc-error" style="display:none; color:red;">Campo obrigatório!</span>

                                </div>
                                <div class="col">
                                    <label for="estadoCivil">Estado Civil<span style="color: red;">*</span></label>
                                    <select type="text" class="form-control" name="estadoCivil" id="estadoCivil" <?php echo $dadoQuery['formulario_enviado_dados'] == 1? 'disabled': ''?> required>
                                        <option value=""></option>
                                        <option value="Solteiro(a)" <?php echo (isset($dadoQuery['ESTADO_CIVIL']) ? ($dadoQuery['ESTADO_CIVIL'] == "Solteiro(a)" ? "Selected":''): '') ?>>Solteiro(a)</option>
                                        <option value="Casado(a)" <?php echo (isset($dadoQuery['ESTADO_CIVIL']) ? ($dadoQuery['ESTADO_CIVIL'] == "Casado(a)" ? "Selected":''): '') ?>>Casado(a)</option>
                                        <option value="Divorciado(a)" <?php echo (isset($dadoQuery['ESTADO_CIVIL']) ? ($dadoQuery['ESTADO_CIVIL'] == "Divorciado(a)" ? "Selected":''): '') ?>>Divorciado(a)</option>
                                    </select>
                                    <span id="estadoCivil-error" style="display:none; color:red;">Campo obrigatório!</span>

                                </div>
                                <div class="col">
                                    <label for="telefone">Telefone<span style="color: red;">*</span></label>
                                    <input type="number" class="form-control" value="<?php echo isset($dadoQuery['TELEFONE']) ? $dadoQuery['TELEFONE']: '' ?>" name="telefone" id="telefone" <?php echo $dadoQuery['formulario_enviado_dados'] == 1? 'disabled': ''; ?> required>
                                    <span id="telefone-error" style="display:none; color:red;">Campo obrigatório!</span>
                                </div>
                            </div>
                    
                            
                            <div class="form-row">
                                <div class="col">
                                    <label for="linkedin">LinkedIn</label>
                                    <input type="text" class="form-control" placeholder="Coloque o link do seu LinkedIn aqui" value="<?php echo isset($dadoQuery['LINKEDIN']) ? $dadoQuery['LINKEDIN']: '' ?>"  name="linkedin" id="linkedin" <?php echo $dadoQuery['formulario_enviado_dados'] == 1? 'disabled': ''?> >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <!-- <div class="alert alert-info" role="alert"  style="width:100%;">
                                        <a style="text-decoration:none;" class="alert-link">Aproveite para falar sobre você, experiências profissionais e objetivos de vida!</a>
                                    </div> -->
                                    <label for="objetivo">Sobre</label>
                                    <textarea type="text" class="form-control" placeholder="Fale sobre você, suas expências, habilidades e objetivos" name="objetivo" id="objetivo" <?php echo $dadoQuery['formulario_enviado_dados'] == 1? 'disabled': ''?>><?php echo isset($dadoQuery['SOBRE']) ? $dadoQuery['SOBRE']: '' ?></textarea>
                                </div>
                            </div>
                        <div style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" value="editar" id="editDadosUser" <?php echo $dadoQuery['formulario_enviado_dados'] == 1?  'show':  'hidden'?> onclick="editDados()">Editar</button>
                                <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar" id="salvarDadosUser" onclick="criarDados()" <?php echo $dadoQuery['formulario_enviado_dados'] == 0?  'show':  'hidden'?>>Salvar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>
</div>


    <script src="../../src/JS/app.js"></script>
    <script src="../../src/JS/processos.js"></script>
    <script src="../../src/JS/swetalert2.js"></script>
    <script src="../../src/JS/jquery-3.7.1.js"></script>  
    <script src="../../src/JS/sidebar.js"></script>
      
</body>
</html>