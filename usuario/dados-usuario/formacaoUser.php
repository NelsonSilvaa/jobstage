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
    <title>Formação</title>
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
            <!-- FORMAÇAO -->
                    <div class="" id="formacao">
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
                                                        '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter'.$id_table.'">EDITAR</button> 
                                                        <button type="button" class="btn btn-danger" onclick="deletarFormacao(' . $row->ID_FORMACAO . ')">REMOVER</button>
                                            '."</td>";
                                        print "</tr>";
                                       
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
                                                    
                                                                    <form>
                                                                        <input type="hidden" name="TIPO" value="EDITAR-FORMACAO">
                                                                        <input type="hidden" name="ID_FORM" value="'. $row->ID_FORMACAO .'">
                                                                        <div class="form-row">
                                                                            <div class="col">
                                                                                <label for="curso">Curso<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="" name="curso" id="cursoInsert'. $row->ID_FORMACAO .'" value="' . $formQuery["CURSO"].'">
                                                                                <span id="curso-error-edit'. $row->ID_FORMACAO .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="instituicao">Instituição<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="" name="instituicao" id="instituicaoInsert'. $row->ID_FORMACAO .'"  value="'.$formQuery["INSTITUICAO"].'">
                                                                                <span id="instituicao-error-edit'. $row->ID_FORMACAO .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                        </div>
                                                    
                                                                        <div class="form-row">
                                                                            <div class="col">
                                                                                <label for="nivel">Nível<span style="color: red;">*</span></label>
                                                                                <select type="text" class="form-control" name="nivel" id="nivelInsert'. $row->ID_FORMACAO .'">
                                                                                    <option value=""></option>
                                                                                    <option value="fundamental" '. (isset($formQuery['NIVEL']) ? ($formQuery['NIVEL'] == "fundamental" ? "Selected":''): '').'> Fundamental </option>
                                                                                    <option value="ensino médio" '. (isset($formQuery['NIVEL']) ? ($formQuery['NIVEL'] == "ensino médio" ? "Selected":''): '').'> Ensino médio </option>
                                                                                    <option value="tecnico" '. (isset($formQuery['NIVEL']) ? ($formQuery['NIVEL'] == "tecnico" ? "Selected":''): '').'> Técnico </option>
                                                                                    <option value="tecnologo" '. (isset($formQuery['NIVEL']) ? ($formQuery['NIVEL'] == "tecnologo" ? "Selected":''): '').'> Tecnólogo </option>
                                                                                    <option value="bacharelado" '. (isset($formQuery['NIVEL']) ? ($formQuery['NIVEL'] == "bacharelado" ? "Selected":''): '').'> Bacharelado </option>
                                                                                    <option value="mestrado" '. (isset($formQuery['NIVEL']) ? ($formQuery['NIVEL'] == "mestrado" ? "Selected":''): '').'> Mestrado </option>
                                                                                    <option value="doutorado" '. (isset($formQuery['NIVEL']) ? ($formQuery['NIVEL'] == "doutorado" ? "Selected":''): '').'> Doutorado </option>
                                                                                    <option value="livre" '. (isset($formQuery['NIVEL']) ? ($formQuery['NIVEL'] == "livre" ? "Selected":''): '').'> Livre </option>
                                                                                </select>
                                                                                <span id="nivel-error-edit'. $row->ID_FORMACAO .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="duracao">Duração<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="" name="duracao" id="duracaoInsert'. $row->ID_FORMACAO .'"  value="' .$formQuery["DURACAO"].'">
                                                                                <span id="duracao-error-edit'. $row->ID_FORMACAO .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="status">Status<span style="color: red;">*</span></label>
                                                                                <select type="text" class="form-control" placeholder="" name="statusInsert" id="statusInsert'. $row->ID_FORMACAO .'">
                                                                                    <option value=""></option>
                                                                                    <option value="completo" '. (isset($formQuery['STATUS']) ? ($formQuery['STATUS'] == "completo" ? "Selected":''): '').'>Completo</option>
                                                                                    <option value="em andamento" '. (isset($formQuery['STATUS']) ? ($formQuery['STATUS'] == "em andamento" ? "Selected":''): '').'>Em andamento</option>
                                                                                    <option value="interrompido" '. (isset($formQuery['STATUS']) ? ($formQuery['STATUS'] == "interrompido" ? "Selected":''): '').'>Interrompido</option>
                                                                                </select>
                                                                                <span id="status-error-edit'. $row->ID_FORMACAO .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                        
                                                        </div>
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-primary" onclick="editarFormacao('. $row->ID_FORMACAO .')">Salvar</button>
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
                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin: 0 auto">
                                Nova formação
                            </a>
                        </p>

                        

                
                        <!-- FORMULARIO PAR ADICIONAR NOVOS DADOS -->
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                            
                                <form>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="curso">Curso<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" placeholder="Ex: Fundamental" name="curso" id="cursoInsert">
                                            <span id="curso-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                        <div class="col">
                                            <label for="instituicao">Instituição<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" placeholder="Ex: Colégio Estadual São Vicente" name="instituicao" id="instituicaoInsert">
                                            <span id="instituicao-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                    </div>
                            
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="nivelInsert">Nível<span style="color: red;">*</span></label>
                                            <select type="text" class="form-control" placeholder="" name="nivel" id="nivelInsert">
                                                <option value=""></option>
                                                <option value="fundamental">Fundamental</option>
                                                <option value="ensino médio">Ensino médio</option>
                                                <option value="tecnico">Técnico</option>
                                                <option value="tecnologo">Tecnólogo</option>
                                                <option value="bacharelado">Bacharelado</option>
                                                <option value="mestrado">Mestrado</option>
                                                <option value="doutorado">Doutorado</option>
                                                <option value="livre">Livre</option>
                                            </select>
                                            <span id="nivel-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                        <div class="col">
                                            <label for="duracao">Duração<span style="color: red;">*</span></label>
                                            <input type="number" class="form-control" placeholder="Duração em anos" name="duracao" id="duracaoInsert">
                                            <span id="duracao-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                        <div class="col">
                                            <label for="status">Status<span style="color: red;">*</span></label>
                                            <select type="text" class="form-control" placeholder="" name="status" id="statusInsert">
                                                <option value=""></option>
                                                <option value="completo">Completo</option>
                                                <option value="em andamento">Em andamento</option>
                                                <option value="interrompido">Interrompido</option>
                                            </select>
                                            <span id="status-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar" onclick="novaFormacao()">Salvar</button>
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
    <script src="../../src/JS/processos.js"></script>
    <script src="../../src/JS/app.js"></script>
    <script src="../../src/JS/swetalert2.js"></script>
    <script src="../../src/JS/jquery-3.6.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-kSpN/7CfdBjN9+RY5DhN5Hz5zr+ZnysK8W1ufX0ZN0SPR20BpZiDgmWwfdKvSGtl" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>