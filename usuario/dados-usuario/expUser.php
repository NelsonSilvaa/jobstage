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
    
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/layout.css">
    <link rel="stylesheet" href="../../css/sweetalert2.css">
    <link rel="stylesheet" href="../../css/validacoes.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/sidebar.css">
    <script src="../../src/JS/jquery-3.7.1.js"></script>
    
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
                <a id="dados-link" class="flex-sm-fill text-sm-center nav-link" href="dadosUser.php">Dados</a>
                <a id="formacao-link" class="flex-sm-fill text-sm-center nav-link" href="formacaoUser.php">Formação</a>
                <a id="exp-link" class="flex-sm-fill text-sm-center nav-link" href="expUser.php">Experiência</a>
                <a id="curso-link" class="flex-sm-fill text-sm-center nav-link" href="cursoUser.php">Cursos</a>
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
                                            print    "<td>".($row->FIM?$row->FIM:'Atual')."</td>";
                                            print    "<td>". '<button type="button" class="btn btn-primary editarExp" data-toggle="modal" id="editarExp" value="'.$row->ID_EXPERIENCIA.'" data-target="#ModalEditEXP'.$id_table.'">EDITAR</button> 
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
                                                                                <label for="empresa">Empresa<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="" name="empresa" id="empresaEdit'. $row->ID_EXPERIENCIA .'" value="'.$expQuery['EMPRESA'].'">
                                                                                <span id="empresa-error-Edit'. $row->ID_EXPERIENCIA .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="cargo">Cargo<span style="color: red;">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="" name="cargo" id="cargoEdit'. $row->ID_EXPERIENCIA .'" value="'.$expQuery['CARGO'].'">
                                                                                <span id="cargo-error-insEditert'. $row->ID_EXPERIENCIA .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                        </div>
                                                                
                                                                        <div class="form-row">
                                                                            <div class="col">
                                                                                <label for="data-inicio">Inicio<span style="color: red;">*</span></label>
                                                                                <input type="date" class="form-control" placeholder="" name="data-inicio" id="inicioEdit'. $row->ID_EXPERIENCIA .'" value="'.$expQuery['INICIO'].'">
                                                                                <span id="di-error-Edit'. $row->ID_EXPERIENCIA .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="data-fim">Fim<span style="color: red;">*</span></label>
                                                                                <input type="date" class="form-control" placeholder="" name="data-fim" id="fimEdit'. $row->ID_EXPERIENCIA .'" value="'. ($expQuery['FIM']? $expQuery['FIM']: 'Atual').'" >
                                                                                <input class="id_edit" value="'.$row->ID_EXPERIENCIA.'" id="cargo-atualEdit'.$row->ID_EXPERIENCIA.'" type="checkbox">Cargo atual?
                                                                                <span id="df-error-Edit'. $row->ID_EXPERIENCIA .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="tipo_contrato">Tipo contrato<span style="color: red;">*</span></label>
                                                                                <select type="text" class="form-control" placeholder="" name="tipo_contrato" id="tipo_contratoEdit'. $row->ID_EXPERIENCIA .'" value="'.$expQuery['TIPO_CONTRATO'].'">
                                                                                    <option value=""></option>
                                                                                    <option value="CLT" '. (isset($expQuery['TIPO_CONTRATO']) ? ($expQuery['TIPO_CONTRATO'] == "CLT" ? "Selected":''): '').'>CLT</option>
                                                                                    <option value="PJ" '. (isset($expQuery['TIPO_CONTRATO']) ? ($expQuery['TIPO_CONTRATO'] == "PJ" ? "Selected":''): '').'>PJ</option>
                                                                                    <option value="estagio" '. (isset($expQuery['TIPO_CONTRATO']) ? ($expQuery['TIPO_CONTRATO'] == "estagio" ? "Selected":''): '').'>Estágio</option>
                                                                                    <option value="temporario" '. (isset($expQuery['TIPO_CONTRATO']) ? ($expQuery['TIPO_CONTRATO'] == "temporario" ? "Selected":''): '').'>Temporário</option>
                                                                                </select>
                                                                                <span id="tipo_contrato-error-Edit'. $row->ID_EXPERIENCIA .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                            </div>
                                                                        </div>
                                                                
                                                                        <div class="form-group">
                                                                            <label for="atividades">Atividades<span style="color: red;">*</span></label>
                                                                            <textarea class="form-control" name="atividades" id="atividadesEdit'. $row->ID_EXPERIENCIA .'" rows="3">'. $expQuery['ATIVIDADES'].'</textarea>
                                                                            <span id="atividades-error-Edit'. $row->ID_EXPERIENCIA .'" style="display:none; color:red;">Campo obrigatório!</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                        <button type="submit" class="btn btn-primary" onclick="editarExp('. $row->ID_EXPERIENCIA .')">Salvar</button>
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
                                                <label for="empresa">Empresa<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" placeholder="" name="empresa" id="empresaInsert" >
                                                <span id="empresa-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                            </div>
                                            <div class="col">
                                                <label for="cargo">Cargo<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" placeholder="Ex: Administrativo" name="cargo" id="cargoInsert" >
                                                <span id="cargo-error-insert" style="display:none; color:red;">Campo obrigatório!</span>
                                            </div>
                                        </div>
                                
                                        <div class="form-row">
                                            <div class="col">
                                                <label for="data-inicio">Inicio<span style="color: red;">*</span></label>
                                                <input type="date" class="form-control" placeholder="" name="data-inicio" id="inicioInsert">
                                                <span id="di-error-insert" style="display:none; color:red;">Campo obrigatório!</span>

                                            </div>
                                            <div class="col">
                                                <label for="data-fim">Fim<span style="color: red;">*</span></label>
                                                <input type="date" class="form-control" placeholder="" name="data-fim" id="fimInsert">
                                                <span><input id="cargo-atual" type="checkbox">Cargo atual?</span>
                                                <span id="df-error-insert" style="display:none; color:red;">Campo obrigatório!</span>

                                            </div>
                                            <div class="col">
                                                <label for="tipo_contrato">Tipo contrato<span style="color: red;">*</span></label>
                                                <select type="text" class="form-control" name="tipo_contrato" id="tipo_contratoInsert">
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
                                            <label for="atividades">Atividades<span style="color: red;">*</span></label>
                                            <textarea class="form-control" name="atividades" placeholder="Descreva suas atividades e deveres nesta experiência" id="atividadesInsert" rows="3"></textarea>
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
</div>
<script>
    $(document).ready(function() {
        $('#cargo-atual').click(function() {
           if ( $('#cargo-atual').prop('checked')){

                 $('#fimInsert').prop('type', 'text');
                $('#fimInsert').prop('placeholder', 'Atual');
                $('#fimInsert').val('');
                $('#fimInsert').prop('disabled', true);
           }else{
                $('#fimInsert').prop('disabled', false);
                $('#fimInsert').prop('type', 'date');
                $('#fimInsert').prop('disabled', false);
           }
        });

        
    });

</script>


    <script src="../../src/JS/app.js"></script>
    <script src="../../src/JS/processos.js"></script>
    <script src="../../src/JS/swetalert2.js"></script>
    <script src="../../src/JS/sidebar.js"></script>    
</body>
</html>