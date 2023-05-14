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
    <title>Cursos</title>
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
            <a class="flex-sm-fill text-sm-center nav-link active" href="dadosUser.php">Dados</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="formacaoUser.php">Formação</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="expUser.php">Experiência</a>
            <a class="flex-sm-fill text-sm-center nav-link " href="cursoUser.php">Cursos</a>
        </nav>
        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
            <!-- CURSOS -->
                    <div class="" id="cursos" >
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
                                                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModalCurso'.$id_table.'">EDITAR</button> 
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletarModalCurso'.$id_table.'">REMOVER</button>
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
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">NÃO</button>
                                                        <button type="button" class="btn btn-primary deletar-linha" onclick="deletarCurso(' . $row->ID_CURSO . ')" data-dismiss="modal">SIM</button>  
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
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin: 0 auto">
                                Novo Curso
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body"> 

                                <form>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="nome-curso">Nome</label>
                                            <input type="text" class="form-control" placeholder="" name="nome-curso" id="nome-cursoInsert">
                                            <span id="nome-curso-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                        <div class="col">
                                            <label for="instituicao-curso">Instituição</label>
                                            <input type="text" class="form-control" placeholder="" name="instituicao-curso" id="instituicao-cursoInsert">
                                            <span id="instituicao-curso-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                    </div>
                            
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="status-curso">Status</label>
                                            <select type="text" class="form-control" placeholder="" name="status-curso" id="status-cursoInsert">
                                                <option value=""></option>
                                                <option value="completo">Completo</option>
                                                <option value="em andamento">Em andamento</option>
                                                <option value="interrompido">Interrompido</option>
                                            </select>
                                            <span id="status-curso-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                        <div class="col">
                                            <label for="duracao-curso">Duração</label>
                                            <input type="number" class="form-control" placeholder="" name="duracao-curso" id="duracao-cursoInsert">
                                            <span id="duracao-curso-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                        <div class="col">
                                            <label for="n-tecnico">Nivel Técnico</label>
                                            <input type="text" class="form-control" placeholder="" name="n-tecnico" id="n-tecnicoInsert">
                                            <span id="n-tecnico-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                        
                                    </div>
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar" onclick="novoCurso()">Salvar</button>
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
    <script src="../../src/JS/swetalert2.js"></script>
    <script src="../../src/JS/jquery-3.6.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-kSpN/7CfdBjN9+RY5DhN5Hz5zr+ZnysK8W1ufX0ZN0SPR20BpZiDgmWwfdKvSGtl" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>