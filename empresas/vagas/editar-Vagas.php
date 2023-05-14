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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/layout.css">
    <link rel="stylesheet" href="../../css/sweetalert2.css">
    <link rel="stylesheet" href="../../css/validacoes.css">
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
          <li><a href="../index.php">Inicio</a></li>
          <!-- <li><a href="cadastroUser.php">Dados</a></li> -->
          <li><a href="#">Vagas</a></li>
          <li><a href="cadastro-vagas.php">> Nova vaga</a></li>
          <li><a href="editar-vagas.php">> Editar vagas</a></li>
          <li><a href="candidaturas.php">Candidaturas</a></li>
          <!-- <li><a href="curriculo.php">Funcionários</a></li> -->
          <li style="background-color: red;"> <a href="../../src/configs/logout.php">Sair</a></li>
      </ul>
  </div>
</div>
  <!-- <div class="alert alert-info" role="alert"  style="width:100%;  text-align:center;">
    <a style="text-decoration:none;"><b>EDITAR VAGAS</b></a>
</div> -->

<div class="container container-vagas">
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarModalVagas'.$id_table.'">EDITAR</button> 
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
                                                        <option value="Manhã">Manhã</option>
                                                        <option value="Tarde">Tarde</option>
                                                        <option value="Noite">Noite</option>
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
                                                        <option value="CLT">CLT</option>
                                                        <option value="PJ">PJ</option>
                                                        <option value="estagio">Estágio</option>
                                                        <option value="temporario">Temporário</option>
                                                    </select>
                                                    <span id="contrato-error" style="display:none; color:red;">Campo obrigatório!</span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="atividades">Atividades<span style="color: red;">*</span> </label>
                                                    <textarea class="form-control" name="atividades" id="atividades'.$row->ID_VAGA.'" rows="3" value="'.$vagaQuery["DESCRICAO"].'"></textarea>
                                                    <span id="atv-error" style="display:none; color:red;">Campo obrigatório!</span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="requisitos">Requisitos:<span style="color: red;"></span> </label>
                                                    <textarea class="form-control" name="requisitos" id="requisitos'.$row->ID_VAGA.'" rows="3" value="'.$vagaQuery["REQUISITOS"].'"></textarea>
                                                    <span id="requisitos-error" style="display:none; color:red;">Campo obrigatório!</span>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="botoes-vagas">
                                    <div class="btn-editar-vaga">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button> 
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

 
    <script src="../../src/JS/jquery-3.6.4.js"></script>
    <script src="../../src/JS/processos.js"></script>
    <script src="../../src/JS/swetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-kSpN/7CfdBjN9+RY5DhN5Hz5zr+ZnysK8W1ufX0ZN0SPR20BpZiDgmWwfdKvSGtl" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>