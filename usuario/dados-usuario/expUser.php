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
    <title>Experiência</title>
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
            <!-- EXPERIENCIA  -->
                    <div class="" id="experiencia">
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
                                        print    "<td>". '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEditEXP'.$id_table.'">EDITAR</button> 
                                                    <button type="button" class="btn btn-danger" onclick="deletarExperiencia(' . $row->ID_EXPERIENCIA . ')">REMOVER</button>
                                                '."</td>";
                                        print "</tr>";

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
                                <?php } ?>
                            <?php 
                            }else{ echo '<p style="color: red; font-size:20px">Nenhuma experiência encontrada!</p>';}
                            ?>
                        <p>
                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin: 0 auto">
                                Nova Experiência
                            </a>
                        </p>
                        

                        <!-- FORMULARIO PARA INSERIR DADOS -->
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">        


                                <form>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="empresa">Empresa</label>
                                            <input type="text" class="form-control" placeholder="" name="empresa" id="empresaInsert" >
                                            <span id="empresa-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                        <div class="col">
                                            <label for="cargo">Cargo</label>
                                            <input type="text" class="form-control" placeholder="" name="cargo" id="cargoInsert" >
                                            <span id="cargo-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                        </div>
                                    </div>
                            
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="data-inicio">Inicio</label>
                                            <input type="date" class="form-control" placeholder="" name="data-inicio" id="inicioInsert">
                                            <span id="di-error-insert" style="display:none; color:red;">Campo obrigatório!</span>

                                        </div>
                                        <div class="col">
                                            <label for="data-fim">Fim</label>
                                            <input type="date" class="form-control" placeholder="" name="data-fim" id="fimInsert">
                                            <span id="df-error-insert" style="display:none; color:red;">Campo obrigatório!</span>

                                        </div>
                                        <div class="col">
                                            <label for="tipo_contrato">Tipo contrato</label>
                                            <select type="text" class="form-control" placeholder="" name="tipo_contrato" id="tipo_contratoInsert">
                                                <option value=""></option>
                                                <option value="CLT">CLT</option>
                                                <option value="PJ">PJ</option>
                                                <option value="estagio">Estágio</option>
                                                <option value="temporario">Temporário</option>
                                            </select>
                                            <span id="tipo_contrato-error-insert" style="display:none; color:red;">Campo obrigatório!</span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="atividades">Atividades</label>
                                        <textarea class="form-control" name="atividades" id="atividadesInsert" rows="3"></textarea>
                                        <span id="atividades-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                    </div>
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar" onclick="novaExp()">Salvar</button>
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