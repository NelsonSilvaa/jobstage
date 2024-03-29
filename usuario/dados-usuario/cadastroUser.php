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
    
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/layout.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../../src/JS/jquery-3.7.1.js"></script>
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
            <li><a href="cadastroUser.php">Dados</a></li>
            <li><a href="../vagas.php">Vagas</a></li>
            <li><a href="../candidaturas.php">Candidaturas</a></li>
            <li><a href="curriculo.php">Currículo</a></li>
            <li style="background-color: red;"> <a href="../../src/configs/logout.php">Sair</a></li>
        </ul>
    </div>


    <div class="container-dados">
        <nav class="nav nav-pills flex-column flex-sm-row card">
            <a class="flex-sm-fill text-sm-center nav-link active" href="dadosUser.php">Dados</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="formacaoUser.php">Formação</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="expUser.php">Experiência</a>
            <a class="flex-sm-fill text-sm-center nav-link " href="cursoUser.php">Cursos</a>
        </nav>
        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
            <!-- DADOS -->
                    <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="dados-tab">
                        <form method="post" action="../../src/read-inputs/dados.php">
                            <div class="form-row">
                                <div class="col">
                                    <label for="Nome">Nome Completo <span style="color: red;">*</span> </label>
                                    <input type="text" class="form-control" placeholder="Nome completo" name="nome" id="nome" value="<?php echo isset($dadoQuery['NOME']) ? $dadoQuery['NOME']: '' ?> " <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                </div>
                                <div class="col">
                                    <label for="email">Email<span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" value="<?php echo isset($dadoQuery['EMAIL']) ? $dadoQuery['EMAIL']: '' ?>" name="email" id="email" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                </div>
                            </div>
                    
                            <div class="form-row">
                                <div class="col">
                                    <label for="data-nasc">Data Nasc.<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" value="<?php echo isset($dadoQuery['DATA_NASC']) ? $dadoQuery['DATA_NASC']: '' ?>" name="data-nasc" id="data-nasc" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                </div>
                                <div class="col">
                                    <label for="estado-civil">Estado Civil<span style="color: red;">*</span></label>
                                    <select type="text" class="form-control" name="estado-civil" id="estado-civil" required>
                                        <option value=""></option>
                                        <option value="Solteiro(a)">Solteiro(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="telefone">Telefone<span style="color: red;">*</span></label>
                                    <input type="number" class="form-control" value="" name="telefone" id="telefone" required>
                                </div>
                            </div>
                    
                            
                            <div class="form-row">
                                <div class="col">
                                    <label for="linkedin">LinkedIn<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder=""  name="linkedin" id="linkedin" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <!-- <div class="alert alert-info" role="alert"  style="width:100%;">
                                        <a style="text-decoration:none;" class="alert-link">Aproveite para falar sobre você, experiências profissionais e objetivos de vida!</a>
                                    </div> -->
                                    <label for="objetivo">Sobre<span style="color: red;">*</span></label>
                                    <textarea type="text" class="form-control" placeholder=""  name="objetivo" id="objetivo" required></textarea>
                                </div>
                                <div class="col">
                                    <label for="data-emissao">Data emissão<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" value="<?php echo isset($dadoQuery['DATA_EMISSAO']) ? $dadoQuery['DATA_EMISSAO']: '' ?>" name="data-emissao" id="data-emissao" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                </div>
                                <div class="col">
                                    <label for="orgao-emissor">Orgão Emissor<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="<?php echo isset($dadoQuery['ORGAO_EMISSOR']) ? $dadoQuery['ORGAO_EMISSOR']: '' ?>" name="orgao-emissor" id="orgao-emissor" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                </div>
                                <div class="col">
                                    <label for="estado">Estado<span style="color: red;">*</span></label>
                                    <select type="text" class="form-control" placeholder="abc" name="estado" id="estado" <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?> required>
                                        <option value=""></option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                            </div>
                        <div style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar"  <?php if(isset($_SESSION['formulario_enviado_dados'])) echo 'disabled'; ?>>Salvar</button>
                        </div>
                        </form>
                    </div>
            <!-- FORMAÇAO -->
                    <div class="tab-pane fade" id="formacao" role="tabpanel" aria-labelledby="formacao-tab">
                        <!-- se não existir nenhuma frmação cadastrada no banco ele nãpo mostra a tabela -->

                        <?php if($total_F['total'] > 0) {
                            $sql = "SELECT * FROM formacao WHERE ID_USUARIO = $user_id";
                            
                            $res = $conn->query($sql);

                            $qtd = $res->num_rows;
                        ?>  

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col" style="display: none;">#</th>
                                    <th scope="col">Nível</th>
                                    <th scope="col">Instituição</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Opção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- LOOP para mostrar cformação cadastrada -->
                                <?php if($qtd > 0) { 
                                    $id_table = 1;
                                    while ($row = $res->fetch_object()){    
                                        print "<tr>";
                                        print    "<td scope='row' data-row-id='$row->ID_FORMACAO' style='display: none;'>".$id_table."</td>";
                                        print    "<td scope='row'>".$row->NIVEL."</td>";
                                        print    "<td>".$row->INSTITUICAO."</td>";
                                        print    "<td>".$row->CURSO."</td>";
                                        print    "<td>".$row->STATUS."</td>";
                                        print    "<td>". 
                                                        '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter'.$id_table.'">EDITAR</button> 
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarModal'.$id_table.'">REMOVER</button>
                                            '."</td>";
                                        print "</tr>";
                                        
                                        print '<div class="modal fade delete-modal-hide" id="deletarModal'.$id_table.'" tabindex="-1" role="dialog" aria-labelledby="deletarModal" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="alert alert-danger" role="alert"  style="width:100%; text-align:center;">
                                                            <a style="text-decoration:none;" class="alert-link">ATENÇÃO</a> quer mesmo  <a style="text-decoration:none;" class="alert-link">DELETAR</a> essas informações?
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="modal-footer-deletar">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NÃO</button>
                                                        <button type="button" class="btn btn-primary deletar-linha" onclick="deletarFormacao(' . $row->ID_FORMACAO . ')" data-bs-dismiss="modal">SIM</button>  
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div> ';

                                        $queryFormacao = "SELECT * FROM formacao WHERE ID_USUARIO = $user_id AND ID_FORMACAO = $row->ID_FORMACAO";
                                        $resultadoF = mysqli_query($conn, $queryFormacao);
                                        $formQuery = mysqli_fetch_assoc($resultadoF);
                                        // <!-- ADICIONANDO NOVA DIV PARA ALTERAR DADOS -->
                                        print '<div class="modal fade exampleModalCenter" id="exampleModalCenter'.$id_table.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
                                                                    <a style="text-decoration:none;" class="alert-link">ATENÇÃO</a> você está <a style="text-decoration:none;" class="alert-link">EDITANDO</a> essas informações!
                                                                </div>
                                                    
                                                            </div>
                                                        <div class="modal-body">
                                                            
                                                            <div class="" id="">
                                                                <div class="card card-body">
                                                    
                                                                    <form method="post" action="../../src/update/updateFormularios.php">
                                                                        <input type="hidden" name="TIPO" value="EDITAR-FORMACAO">
                                                                        <input type="hidden" name="ID_FORM" value="'. $row->ID_FORMACAO .'">
                                                                        <div class="form-row">
                                                                            <div class="col">
                                                                                <label for="curso">Curso<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="" name="curso" id="curso" value="' . $formQuery["CURSO"].'">
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="instituicao">Instituição<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="" name="instituicao" id="instituicao"  value="'.$formQuery["INSTITUICAO"].'">
                                                                            </div>
                                                                        </div>
                                                    
                                                                        <div class="form-row">
                                                                            <div class="col">
                                                                                <label for="nivel">Nível<span style="color: red;">*</span></label>
                                                                                <select type="text" class="form-control" name="nivel" id="nivel">
                                                                                    <option value="AAA">Fundamental</option>
                                                                                    <option value="ensino médio">Ensino médio</option>
                                                                                    <option value="tecnico">Técnico</option>
                                                                                    <option value="tecnologo">Tecnólogo</option>
                                                                                    <option value="bacharelado">Bacharelado</option>
                                                                                    <option value="mestrado">Mestrado</option>
                                                                                    <option value="doutorado">Doutorado</option>
                                                                                    <option value="livre">Livre</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="duracao">Duração<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="" name="duracao" id="duracao"  value="' .$formQuery["DURACAO"].'">
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="status">Status<span style="color: red;">*</span></label>
                                                                                <select type="text" class="form-control" placeholder="" name="status" id="status">
                                                                                    <option value=""></option>
                                                                                    <option value="completo">Completo</option>
                                                                                    <option value="em andamento">Em andamento</option>
                                                                                    <option value="interrompido">Interrompido</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                        
                                                        </div>
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>';
                                        $id_table += 1;
                                    }
                                ?>

                                </tbody>
                            </table>
                        <?php } ?>
                        <?php 
                        } else { 
                            echo '<p style="color: red; font-size:20px">Nenhuma formação encontrada!</p>';
                        }
                        ?>

                        <p>
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin: 0 auto">
                                Nova formação
                            </a>
                        </p>

                        

                
                        <!-- FORMULARIO PAR ADICIONAR NOVOS DADOS -->
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                            
                                <form method="post" action="../../src/read-inputs/formacao.php">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="curso">Curso<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" placeholder="" name="curso" id="curso">
                                        </div>
                                        <div class="col">
                                            <label for="instituicao">Instituição<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" placeholder="" name="instituicao" id="instituicao">
                                        </div>
                                    </div>
                            
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="nivel">Nível<span style="color: red;">*</span></label>
                                            <select type="text" class="form-control" placeholder="" name="nivel" id="nivel">
                                                <option value="AAA">Fundamental</option>
                                                <option value="ensino médio">Ensino médio</option>
                                                <option value="tecnico">Técnico</option>
                                                <option value="tecnologo">Tecnólogo</option>
                                                <option value="bacharelado">Bacharelado</option>
                                                <option value="mestrado">Mestrado</option>
                                                <option value="doutorado">Doutorado</option>
                                                <option value="livre">Livre</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="duracao">Duração<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" placeholder="" name="duracao" id="duracao">
                                        </div>
                                        <div class="col">
                                            <label for="status">Status<span style="color: red;">*</span></label>
                                            <select type="text" class="form-control" placeholder="" name="status" id="status">
                                                <option value=""></option>
                                                <option value="completo">Completo</option>
                                                <option value="em andamento">Em andamento</option>
                                                <option value="interrompido">Interrompido</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

            <!-- EXPERIENCIA  -->
                    <div class="tab-pane fade" id="experiencia" role="tabpanel" aria-labelledby="experiencia-tab">
                        <?php 
                            if($total_E['total'] > 0) {

                            $sql = "SELECT * FROM experiencia WHERE ID_USUARIO = $user_id";
                            
                            $res = $conn->query($sql);

                            $qtd = $res->num_rows;
                        ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col" style="display: none;">#</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">contrato</th>
                                        <th scope="col">inicio</th>
                                        <th scope="col">fim</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($qtd > 0) { 
                                        $id_table = 1;
                                    while ($row = $res->fetch_object()){    
                                        print "<tr>";
                                        print    "<td scope='row'>".$row->EMPRESA."</td>";
                                        print    "<td scope='row' data-row-id='$$row->ID_EXPERIENCIA' style='display:none;'>".$id_table."</td>";
                                        print    "<td>".$row->CARGO."</td>";
                                        print    "<td>".$row->TIPO_CONTRATO."</td>";
                                        print    "<td>".$row->INICIO."</td>";
                                        print    "<td>".$row->FIM."</td>";
                                        print    "<td>". '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEditEXP'.$id_table.'">EDITAR</button> 
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarModalExp'.$id_table.'">REMOVER</button>
                                                '."</td>";
                                        print "</tr>";

                                        // DIV PARA DELETAR LINHAS
                                        print '<div class="modal fade delete-modal-hide" id="deletarModalExp'.$id_table.'" tabindex="-1" role="dialog" aria-labelledby="deletarModal" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="alert alert-danger" role="alert"  style="width:100%; text-align:center;">
                                                            <a style="text-decoration:none;" class="alert-link">ATENÇÃO</a> quer mesmo  <a style="text-decoration:none;" class="alert-link">DELETAR</a> essas informações?
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="modal-footer-deletar">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NÃO</button>
                                                        <button type="button" class="btn btn-primary deletar-linha" onclick="deletarExperiencia(' . $row->ID_EXPERIENCIA . ')" data-bs-dismiss="modal">SIM</button>  
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div> ';

                                        $queryEXP = "SELECT * FROM experiencia WHERE ID_USUARIO = $user_id AND ID_EXPERIENCIA =  $row->ID_EXPERIENCIA"; 
                                        $resultadoExp = mysqli_query($conn, $queryEXP);
                                        $expQuery = mysqli_fetch_assoc($resultadoExp);

                                        // MODAL PARA ATUALIZAR DADOS 
                                        print  '<div class="modal fade ModalEditEXP" id="ModalEditEXP'.$id_table.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
                                                                    <a style="text-decoration:none;" class="alert-link">ATENÇÃO</a> você está <a style="text-decoration:none;" class="alert-link">EDITANDO</a> essas informações!
                                                                </div>
                                                    
                                                            </div>
                                                        <!-- modal - body -->
                                                        <div class="modal-body">
                                                            <div class="" id="">
                                                                <div class="card card-body">        
                        
                                                                <form method="post" action="../../src/update/updateFormularios.php">
                                                                <input type="hidden" name="TIPO" value="EDITAR-EXPERIENCIA">
                                                                <input type="hidden" name="ID_EXP" value="'. $row->ID_EXPERIENCIA .'">
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label for="empresa">Empresa</label>
                                                                            <input type="text" class="form-control" placeholder="" name="empresa" id="empresa" value="'.$expQuery['EMPRESA'].'">
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="cargo">Cargo</label>
                                                                            <input type="text" class="form-control" placeholder="" name="cargo" id="cargo" value="'.$expQuery['CARGO'].'">
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <label for="data-inicio">Inicio</label>
                                                                            <input type="date" class="form-control" placeholder="" name="data-inicio" id="inicio" value="'.$expQuery['INICIO'].'">
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="data-fim">Fim</label>
                                                                            <input type="date" class="form-control" placeholder="" name="data-fim" id="fim"value="'. $expQuery['FIM'].'" >
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="tipo_contrato">Tipo contrato</label>
                                                                            <select type="text" class="form-control" placeholder="" name="tipo_contrato" id="tipo_contrato" value="'.$expQuery['TIPO_CONTRATO'].'">
                                                                                <option value=""></option>
                                                                                <option value="CLT">CLT</option>
                                                                                <option value="PJ">PJ</option>
                                                                                <option value="estagio">Estágio</option>
                                                                                <option value="temporario">Temporário</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="form-group">
                                                                        <label for="atividades">Atividades</label>
                                                                        <textarea class="form-control" name="atividades" id="atividades" rows="3" value="'. $expQuery['ATIVIDADES'].'"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>';
                                        $id_table += 1;
                                        
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            <?php 
                            }else{ echo '<p style="color: red; font-size:20px">Nenhuma experiência encontrada!</p>';}
                            ?>
                        <p>
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin: 0 auto">
                                Nova Experiência
                            </a>
                        </p>
                        

                        <!-- FORMULARIO PARA INSERIR DADOS -->
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">        


                                <form method="post" action="../../src/read-inputs/experiencia.php">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="empresa">Empresa</label>
                                            <input type="text" class="form-control" placeholder="" name="empresa" id="empresa" required>
                                        </div>
                                        <div class="col">
                                            <label for="cargo">Cargo</label>
                                            <input type="text" class="form-control" placeholder="" name="cargo" id="cargo" required>
                                        </div>
                                    </div>
                            
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="data-inicio">Inicio</label>
                                            <input type="date" class="form-control" placeholder="" name="data-inicio" id="inicio" required>
                                        </div>
                                        <div class="col">
                                            <label for="data-fim">Fim</label>
                                            <input type="date" class="form-control" placeholder="" name="data-fim" id="fim" required>
                                        </div>
                                        <div class="col">
                                            <label for="tipo_contrato">Tipo contrato</label>
                                            <select type="text" class="form-control" placeholder="" name="tipo_contrato" id="tipo_contrato" required>
                                                <option value=""></option>
                                                <option value="CLT">CLT</option>
                                                <option value="PJ">PJ</option>
                                                <option value="estagio">Estágio</option>
                                                <option value="temporario">Temporário</option>
                                            </select>
                                        </div>
                                    </div>
                            
                                    <div class="form-group">
                                        <label for="atividades">Atividades</label>
                                        <textarea class="form-control" name="atividades" id="atividades" rows="3" required></textarea>
                                    </div>
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            <!-- ESCOLARIDADE -->
                    <!-- <div class="tab-pane fade" id="escolaridade" role="tabpanel" aria-labelledby="escolaridade-tab">
                        <form method="post" action="../../src/read-inputs/escolaridade.php" enctype="multipart/form-data">

                            <div class="form-row">
                                <div class="col">
                                    <label for="curso-escolaridade">Curso<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="<?php echo isset($escQuery['CURSO']) ? $escQuery['CURSO']: '' ?>" name="curso-escolaridade" id="curso-escolaridade" <?php if(isset($_SESSION['formulario_enviado_formacao'])) echo 'readonly'; ?> required>
                                </div>
                                <div class="col">
                                    <label for="instituicao-escolaridade">Instituição<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="<?php echo isset($escQuery['INSTITUICAO']) ? $escQuery['INSTITUICAO']: '' ?>" name="instituicao-escolaridade" id="instituicao-escolaridade" <?php if(isset($_SESSION['formulario_enviado_formacao'])) echo 'readonly'; ?> required>
                                </div>
                            </div>
                    
                            <div class="form-row">
                                <div class="col">
                                    <label for="contato">Contato<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="<?php echo isset($escQuery['CONTATO']) ? $escQuery['CONTATO']: '' ?>" name="contato" id="contato" <?php if(isset($_SESSION['formulario_enviado_formacao'])) echo 'readonly'; ?> required>
                                </div>
                                <div class="col">
                                    <label for="turno">Turno<span style="color: red;">*</span></label>
                                    <select type="text" class="form-control" name="turno" id="turno" <?php if(isset($_SESSION['formulario_enviado_formacao'])) echo 'readonly'; ?> disabled>
                                        <option value="manha">Manhã</option>
                                        <option value="tarde">Tarde</option>
                                        <option value="noite">Noite</option>
                                    </select>
                                </div>
                            </div>
                    
                            <div class="form-row">
                                <div class="col">
                                    <label for="prev-formatura">Previsao formatura<span style="color: red;">*</span></label>
                                    <input type="month" class="form-control" placeholder="<?php echo isset($escQuery['PREVISAO_FORMATURA']) ? $escQuery['PREVISAO_FORMATURA']: '' ?>" name="prev-formatura" id="prev-formatura" <?php if(isset($_SESSION['formulario_enviado_formacao'])) echo 'readonly'; ?> required>
                                </div>
                                <div class="col">
                                    <label for="periodo">Período<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="<?php echo isset($escQuery['PERIODO']) ? $escQuery['PERIODO']: '' ?>" name="periodo" id="periodo" <?php if(isset($_SESSION['formulario_enviado_formacao'])) echo 'readonly'; ?> required>
                                        
                                </div>
                                <div class="col">
                                    <label for="duracao">Duração<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="<?php echo isset($escQuery['DURACAO']) ? $escQuery['DURACAO']: '' ?>" name="duracao" id="duracao" <?php if(isset($_SESSION['formulario_enviado_formacao'])) echo 'readonly'; ?> required>
                                </div>
                            </div>
                    
                            <div class="form-row">
                                <div class="col">
                                    <label for="">DECLARAÇÃO MATRÍCULA<span style="color: red;">*</span></label>
                                    <input type="file" class="form-control" placeholder="" name="declaracao" id="declaracao" <?php if(isset($_SESSION['formulario_enviado_formacao'])) echo 'disabled'; ?> required>
                                </div>
                            </div>
                        <div style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar"  <?php if(isset($_SESSION['formulario_enviado_formacao'])) echo 'disabled'?>>Salvar</button>
                        </div>
                        </form>
                    </div> -->
            <!-- CURSOS -->
                    <div class="tab-pane fade" id="cursos" role="tabpanel" aria-labelledby="cursos-tab">
                    <?php 
                            if($total_C['total'] > 0) {

                            $sql = "SELECT * FROM curso_extra WHERE ID_USUARIO = $user_id";
                            
                            $res = $conn->query($sql);

                            $qtd = $res->num_rows;
                        ?> 
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">Nível</th>
                                    <th scope="col">Instituição</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Opção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($qtd > 0) { 
                                        $id_table = 1;
                                    while ($row = $res->fetch_object()){    
                                        print "<tr>";
                                        print    "<td scope='row' data-row-id='$row->ID_CURSO' style='display: none;'>".$id_table."</td>";
                                        print   "<td scope='row'>".$row->NIVEL_TECNICO."</td>";
                                        print   "<td>".$row->INSTITUICAO."</td>";
                                        print   "<td>".$row->NOME."</td>";
                                        print   "<td>".$row->STATUS."</td>";
                                        print    "<td>". 
                                                    '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModalCurso'.$id_table.'">EDITAR</button> 
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarModalCurso'.$id_table.'">REMOVER</button>
                                                '."</td>";
                                        print "</tr>";
                                        
                                        print '<div class="modal fade delete-modal-hide" id="deletarModalCurso'.$id_table.'" tabindex="-1" role="dialog" aria-labelledby="deletarModal" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="alert alert-danger" role="alert"  style="width:100%; text-align:center;">
                                                            <a style="text-decoration:none;" class="alert-link">ATENÇÃO</a> quer mesmo  <a style="text-decoration:none;" class="alert-link">DELETAR</a> essas informações?
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="modal-footer-deletar">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NÃO</button>
                                                        <button type="button" class="btn btn-primary deletar-linha" onclick="deletarCurso(' . $row->ID_CURSO . ')" data-bs-dismiss="modal">SIM</button>  
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div> ';
                                        
                                        $queryCurso = "SELECT * FROM curso_extra WHERE ID_USUARIO = $user_id AND ID_CURSO = $row->ID_CURSO"; 
                                        $resultadoC_E = mysqli_query($conn, $queryCurso);
                                        $cursoExpQuery = mysqli_fetch_assoc($resultadoC_E);
                                        
                                        // MODAL PARA EDITAR DADOS
                                        print '<div class="modal fade exampleModalCenter" id="editModalCurso'.$id_table.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
                                                                    <a style="text-decoration:none;" class="alert-link">ATENÇÃO</a> você está <a style="text-decoration:none;" class="alert-link">EDITANDO</a> essas informações!
                                                                </div>
                                                    
                                                            </div>
                                                        <div class="modal-body">
                                                            
                                                            <div class="" id="">
                                                                <div class="card card-body">
                                                    
                                                                    <form method="post" action="../../src/update/updateFormularios.php">
                                                                        <input type="hidden" name="TIPO" value="EDITAR-CURSO">
                                                                        <input type="hidden" name="ID_CURSO" value="'. $row->ID_CURSO .'">
                                                                        <div class="form-row">
                                                                            <div class="col">
                                                                                <label for="nome-curso">Nome</label>
                                                                                <input type="text" class="form-control" placeholder="" name="nome-curso" id="nome-curso" value='.$cursoExpQuery['NOME'].'>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="instituicao-curso">Instituição</label>
                                                                                <input type="text" class="form-control" placeholder="" name="instituicao-curso" id="instituicao-curso" value='.$cursoExpQuery['INSTITUICAO'].'>
                                                                            </div>
                                                                        </div>
                                                                
                                                                        <div class="form-row">
                                                                            <div class="col">
                                                                                <label for="status-curso">Status</label>
                                                                                <select type="text" class="form-control" placeholder="" name="status-curso" id="status-curso"required>
                                                                                    <option value=""></option>
                                                                                    <option value="completo">Completo</option>
                                                                                    <option value="em andamento">Em andamento</option>
                                                                                    <option value="interrompido">Interrompido</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="duracao-curso">Duração</label>
                                                                                <input type="text" class="form-control" placeholder="" name="duracao-curso" id="duracao-curso" value='.$cursoExpQuery['DURACAO'].'>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="n-tecnico">Nivel Técnico</label>
                                                                                <input type="text" class="form-control" placeholder="" name="n-tecnico" id="n-tecnico" value='.$cursoExpQuery['NIVEL_TECNICO'].'>
                                                                            </div>
                                                                            
                                                                        </div>                                                                       
                                                                </div>
                                                            </div>
                        
                                                        </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>';
                                        $id_table += 1;
                                    }
                                ?>
                                </tbody>
                            </table>
                        <?php }?>
                        <?php 
                        }else{ echo  '<p style="color: red; font-size:20px">Nenhum curso encontrado!</p>';}
                        ?>
                        <p>
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin: 0 auto">
                                Novo Curso
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body"> 

                                <form method="post" action="../../src/read-inputs/cursos.php">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="nome-curso">Nome</label>
                                            <input type="text" class="form-control" placeholder="" name="nome-curso" id="nome-curso" required>
                                        </div>
                                        <div class="col">
                                            <label for="instituicao-curso">Instituição</label>
                                            <input type="text" class="form-control" placeholder="" name="instituicao-curso" id="instituicao-curso"required>
                                        </div>
                                    </div>
                            
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="status-curso">Status</label>
                                            <select type="text" class="form-control" placeholder="" name="status-curso" id="status-curso"required>
                                                <option value=""></option>
                                                <option value="completo">Completo</option>
                                                <option value="em andamento">Em andamento</option>
                                                <option value="interrompido">Interrompido</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="duracao-curso">Duração</label>
                                            <input type="text" class="form-control" placeholder="" name="duracao-curso" id="duracao-curso"required>
                                        </div>
                                        <div class="col">
                                            <label for="n-tecnico">Nivel Técnico</label>
                                            <input type="text" class="form-control" placeholder="" name="n-tecnico" id="n-tecnico"required>
                                        </div>
                                        
                                    </div>
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>



       
    





    <script src="../../src/JS/app.js"></script>
    <script src="../../src/JS/sidebar.js"></script>
</body>
</html>