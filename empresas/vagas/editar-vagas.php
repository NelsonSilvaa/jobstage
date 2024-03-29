<?php
session_start();

    if(empty($_SESSION)){
        header("Location: ../index.html");
    }
    include("../../src/configs/conexao.php");

    $empresa_id = $_SESSION['ID_EMPRESA'];

    $sql = "SELECT * FROM vagas WHERE ID_EMPRESA = $empresa_id ";
    $resultado = mysqli_query($conn, $sql);
    $Query = mysqli_fetch_assoc($resultado);



    $sqlQtde = "SELECT  COUNT(*) as total FROM vagas WHERE ID_EMPRESA = $empresa_id ";
    $resultadoQtde = mysqli_query($conn, $sqlQtde);
    $total = mysqli_fetch_assoc($resultadoQtde);

?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar vagas</title>
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
    <?php require_once "../../src/template/empresa/sidebar.html" ?>
    
    <div class="content">
        <?php require_once "../../src/template/empresa/navbar.html" ?>

        <div class="container d-flex align-items-center flex-column">
            <?php 
                if ($total['total'] > 0){
                    $sqlLoop = "SELECT * FROM vagas WHERE ID_EMPRESA = $empresa_id";
                                        
                    $res = $conn->query($sqlLoop);

                    $qtd = $res->num_rows;

                ?>
                <?php
                    if($qtd > 0) { 
                        $id_table = 1;
                        
                        while ($row = $res->fetch_object()){ 
                    
                            print '<div class="" data-id='.$id_table.' data-row-id='.$row->ID_VAGA.'>

                                        <div class="card-vaga">
                                            <div class="card-titulo">
                                                <h2>'.$row->NOME.'</2>
                                            </div>
                                            
                                            <div class="titulo-conteudo-prev">
                                                <h3>Descrição</h3>
                                            </div>
                                            <div class="card-conteudo-prev">
                                                <p>'.$row->DESCRICAO.'</p>
                                            </div>
                                            <div class="botoes-vagas">
                                                <div class="btn-editar-vaga">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarModalVagas'.$id_table.'">EDITAR</button> 
                                                </div>
                                                <div class="btn-delete-vaga">
                                                    <button type="button" class="btn btn-danger" id="idDelete" value="'.$row->ID_VAGA.'"onclick="deleteVaga('.$row->ID_VAGA.')">REMOVER</button> 

                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                        <br>
                        <br>';
                        $queryVaga = "SELECT * FROM vagas WHERE ID_EMPRESA = $empresa_id AND ID_VAGA = $row->ID_VAGA";
                        $resultadoV = mysqli_query($conn, $queryVaga);
                        $vagaQuery = mysqli_fetch_assoc($resultadoV);
        // MODAL PARA EDITAR DADOS
                        print '
                            <div class="modal fade exampleModalCenter" id="editarModalVagas'.$id_table.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
                                                <a style="text-decoration:none;" class="alert-link">ATENÇÃO</a> você está <a style="text-decoration:none;" class="alert-link">EDITANDO</a> essas informações!
                                            </div>
                                
                                        </div>
                                        <!-- CONTEUDO DA MODAL -->
                                        <div class="modal-body">
                                            
                                            <div class="" id="">
                                                <div class="card-edit-vagas card-body">
                                                <form>
                                                <input type="hidden" id="ID_VAGA" value="'. $row->ID_VAGA .'">
                                                <input type="hidden" id="tipoVaga" value="editVaga">
                                                
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="nomeVaga">Nome da vaga<span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control" placeholder="Nome da vaga" name="nomeVaga" id="nomeVaga'.$row->ID_VAGA.'" value="'.$vagaQuery["NOME"].'">
                                                            <span id="nome-error" style="display:none; color:red;">Campo obrigatório!</span>

                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="turno">Turno<span style="color: red;">*</span> </label>
                                                            <select type="text" class="form-control" placeholder="abc" name="turno" id="turno'.$row->ID_VAGA.'" value="'.$vagaQuery["TURNO"].'">
                                                                <option value=""></option>
                                                                <option value="Manhã" '. (isset($vagaQuery['TURNO']) ? ($vagaQuery['TURNO'] == "Manhã" ? "Selected":''): '').'>Manhã</option>
                                                                <option value="Tarde" '. (isset($vagaQuery['TURNO']) ? ($vagaQuery['TURNO'] == "Tarde" ? "Selected":''): '').'>Tarde</option>
                                                                <option value="Noite" '. (isset($vagaQuery['TURNO']) ? ($vagaQuery['TURNO'] == "Noite" ? "Selected":''): '').'>Noite</option>
                                                            </select>
                                                            <span id="turno-error" style="display:none; color:red;">Campo obrigatório!</span>
                                                        </div>
                                                        <div class="col">
                                                            <label for="turnoDas">Das<span style="color: red;">*</span> </label>
                                                            <input type="time" class="form-control"  name="turnoDas" id="turnoDas'.$row->ID_VAGA.'" value="'.$vagaQuery["TURNO_DAS"].'">
                                                            <span id="turno-das-error" style="display:none; color:red;">Campo obrigatório!</span>

                                                        </div>
                                                        <div class="col">
                                                            <label for="turnoAte">Até<span style="color: red;">*</span> </label>
                                                            <input type="time" class="form-control" name="turnoAte" id="turnoAte'.$row->ID_VAGA.'" value="'.$vagaQuery["TURNO_ATE"].'">
                                                            <span id="turno-ate-error" style="display:none; color:red;">Campo obrigatório!</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="cidade">Cidade<span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control" placeholder="Cidade" name="cidade" id="cidade'.$row->ID_VAGA.'" value="'.$vagaQuery["CIDADE"].'">
                                                            <span id="cidade-error" style="display:none; color:red;">Campo obrigatório!</span>

                                                        </div>
                                                        <div class="col">
                                                            <label for="estado">Estado<span style="color: red;">*</span> </label>
                                                            <select type="text" class="form-control" placeholder="abc" name="estado" id="estado'.$row->ID_VAGA.'" value="'.$vagaQuery["ESTADO"].'">
                                                                <option value=""></option>
                                                                <option value="AC" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "AC" ? "Selected":''): '').'>Acre</option>
                                                                <option value="AL" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "AL" ? "Selected":''): '').'>Alagoas</option>
                                                                <option value="AP" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "AP" ? "Selected":''): '').'>Amapá</option>
                                                                <option value="AM" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "AM" ? "Selected":''): '').'>Amazonas</option>
                                                                <option value="BA" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "BA" ? "Selected":''): '').'>Bahia</option>
                                                                <option value="CE" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "CE" ? "Selected":''): '').'>Ceará</option>
                                                                <option value="DF" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "DF" ? "Selected":''): '').'>Distrito Federal</option>
                                                                <option value="ES" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "ES" ? "Selected":''): '').'>Espírito Santo</option>
                                                                <option value="GO" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "GO" ? "Selected":''): '').'>Goiás</option>
                                                                <option value="MA" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "MA" ? "Selected":''): '').'>Maranhão</option>
                                                                <option value="MT" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "MT" ? "Selected":''): '').'>Mato Grosso</option>
                                                                <option value="MS" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "MS" ? "Selected":''): '').'>Mato Grosso do Sul</option>
                                                                <option value="MG" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "MG" ? "Selected":''): '').'>Minas Gerais</option>
                                                                <option value="PA" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "PA" ? "Selected":''): '').'>Pará</option>
                                                                <option value="PB" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "PB" ? "Selected":''): '').'>Paraíba</option>
                                                                <option value="PR" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "PR" ? "Selected":''): '').'>Paraná</option>
                                                                <option value="PE" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "PE" ? "Selected":''): '').'>Pernambuco</option>
                                                                <option value="PI" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "PI" ? "Selected":''): '').'>Piauí</option>
                                                                <option value="RJ" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "RJ" ? "Selected":''): '').'>Rio de Janeiro</option>
                                                                <option value="RN" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "RN" ? "Selected":''): '').'>Rio Grande do Norte</option>
                                                                <option value="RS" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "RS" ? "Selected":''): '').'>Rio Grande do Sul</option>
                                                                <option value="RO" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "RO" ? "Selected":''): '').'>Rondônia</option>
                                                                <option value="RR" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "RR" ? "Selected":''): '').'>Roraima</option>
                                                                <option value="SC" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "SC" ? "Selected":''): '').'>Santa Catarina</option>
                                                                <option value="SP" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "SP" ? "Selected":''): '').'>São Paulo</option>
                                                                <option value="SE" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "SE" ? "Selected":''): '').'>Sergipe</option>
                                                                <option value="TO" '. (isset($vagaQuery['ESTADO']) ? ($vagaQuery['ESTADO'] == "TO" ? "Selected":''): '').'>Tocantins</option>
                                                            </select>
                                                            <span id="estado-error" style="display:none; color:red;">Campo obrigatório!</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="salario">Salário<span style="color: red;"></span> </label>
                                                            <input type="text" class="form-control" placeholder="Salário" name="salario" id="salario'.$row->ID_VAGA.'" value="'.$vagaQuery["SALARIO"].'">
                                                        </div>
                                                        <div class="col">
                                                            <label for="contrato">Tipo de contrato<span style="color: red;">*</span> </label>
                                                            <select type="text" class="form-control" placeholder="" name="contrato" id="contrato'.$row->ID_VAGA.'" value="'.$vagaQuery["TIPO_CONTRATO"].'">
                                                                <option value=""></option>
                                                                <option value="CLT" '. (isset($vagaQuery['TIPO_CONTRATO']) ? ($vagaQuery['TIPO_CONTRATO'] == "CLT" ? "Selected":''): '').'>CLT</option>
                                                                <option value="PJ" '. (isset($vagaQuery['TIPO_CONTRATO']) ? ($vagaQuery['TIPO_CONTRATO'] == "PJ" ? "Selected":''): '').'>PJ</option>
                                                                <option value="estagio" '. (isset($vagaQuery['TIPO_CONTRATO']) ? ($vagaQuery['TIPO_CONTRATO'] == "estagio" ? "Selected":''): '').'>Estágio</option>
                                                                <option value="temporario" '. (isset($vagaQuery['TIPO_CONTRATO']) ? ($vagaQuery['TIPO_CONTRATO'] == "temporario" ? "Selected":''): '').'>Temporário</option>
                                                            </select>
                                                            <span id="contrato-error" style="display:none; color:red;">Campo obrigatório!</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="atividades">Atividades<span style="color: red;">*</span> </label>
                                                            <textarea class="form-control" name="atividades" id="atividades'.$row->ID_VAGA.'" rows="3" value="'.$vagaQuery["DESCRICAO"].'">'. (isset($vagaQuery['DESCRICAO']) ? $vagaQuery['DESCRICAO'] :'').'</textarea>
                                                            <span id="atv-error" style="display:none; color:red;">Campo obrigatório!</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="requisitos">Requisitos:<span style="color: red;"></span> </label>
                                                            <textarea class="form-control" name="requisitos" id="requisitos'.$row->ID_VAGA.'" rows="3" value="'.$vagaQuery["REQUISITOS"].'">'. (isset($vagaQuery['REQUISITOS']) ? $vagaQuery['REQUISITOS']: '').'</textarea>
                                                            <span id="requisitos-error" style="display:none; color:red;">Campo obrigatório!</span>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="botoes-vagas">
                                            <div class="btn-editar-vaga">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button> 
                                            </div>
                                            <div class="btn-delete-vaga">
                                                <button type="submit" class="btn btn-primary" onclick="crudVaga('. $row->ID_VAGA .')">Salvar</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>  
                                </div>
                            </div>';

                            $id_table += 1;
                        }
                    }
                ?>   
                <?php
                }else{ ?>
                
                    <div class="alert alert-danger" role="alert"  style="width:100%;  text-align:center;">
                        <a style="text-decoration:none;" class="alert-link"></a> VOCÊ <a style="text-decoration:none;" class="alert-link">NÃO</a> TEM VAGAS AINDA, CRIE UMA!
                    </div>
                    <div>
                        <img src="../../img/img_error.jpg" alt="" width="400px" height="400px" style="opacity: 0.7;">
                    </div>
                
                <?php
                } 
                ?>
        </div>
    </div>
   
</div>
  <!-- <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
    <a style="text-decoration:none;"><b>EDITAR VAGAS</b></a>
</div> -->



 
    <script src="../../src/JS/jquery-3.7.1.js"></script>
    <script src="../../src/JS/processos.js"></script>
    <script src="../../src/JS/swetalert2.js"></script>    
    <script src="../src/JS/sidebar.js"></script>
</body>
</html>