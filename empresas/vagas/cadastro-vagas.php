<?php
session_start();

    if(empty($_SESSION)){
        header("Location: ../index.html");
    }
    include("../../src/configs/conexao.php");

    $empresa_id = $_SESSION['ID_EMPRESA'];

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
    <title>Criar vaga</title>
    
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/layout.css">
    <link rel="stylesheet" href="../../css/sweetalert2.css">
    <link rel="stylesheet" href="../../css/validacoes.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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
                <li><a href="cadastro-vagas.php"> Nova vaga</a></li>
                <li><a href="editar-vagas.php"> Editar vagas</a></li>
                <li><a href="candidaturas.php">Candidaturas</a></li>
                <li style="background-color: red;"> <a href="../../src/configs/logout.php">Sair</a></li>
            </ul>
        </nav>
    </div>

    <div class="container-dados">
        <h2 style="text-align:center; padding: 5px;">CRIE UMA NOVA VAGA AQUI:</h2>
        <div class="card-vaga">
            <form>
            <input type="hidden" id="tipoVaga" value="criaVaga">
                <div class="form-row">
                    <div class="col">
                        <label for="nomeVaga">Nome da vaga<span style="color: red;">*</span> </label>
                        <input type="text" class="form-control" placeholder="Nome da vaga" name="nomeVaga" id="nomeVaga" >
                        <span id="nome-error" style="display:none; color:red;">Campo obrigatório!</span>

                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="turno">Turno<span style="color: red;">*</span> </label>
                        <select type="text" class="form-control" placeholder="abc" name="turno" id="turno">
                            <option value=""></option>
                            <option value="Manhã">Manhã</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Noite">Noite</option>
                        </select>
                        <span id="turno-error" style="display:none; color:red;">Campo obrigatório!</span>
                    </div>
                    <div class="col">
                        <label for="turnoDas">Das<span style="color: red;">*</span> </label>
                        <input type="time" class="form-control"  name="turnoDas" id="turnoDas">
                        <span id="turno-das-error" style="display:none; color:red;">Campo obrigatório!</span>

                    </div>
                    <div class="col">
                        <label for="turnoAte">Até<span style="color: red;">*</span> </label>
                        <input type="time" class="form-control" name="turnoAte" id="turnoAte">
                        <span id="turno-ate-error" style="display:none; color:red;">Campo obrigatório!</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="cidade">Cidade<span style="color: red;">*</span> </label>
                        <input type="text" class="form-control" placeholder="Cidade" name="cidade" id="cidade">
                        <span id="cidade-error" style="display:none; color:red;">Campo obrigatório!</span>

                    </div>
                    <div class="col">
                        <label for="estado">Estado<span style="color: red;">*</span> </label>
                        <select type="text" class="form-control" placeholder="abc" name="estado" id="estado">
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
                        <input type="text" class="form-control" placeholder="Salário" name="salario" id="salario">
                    </div>
                    <div class="col">
                        <label for="contrato">Tipo de contrato<span style="color: red;">*</span> </label>
                        <select type="text" class="form-control" placeholder="" name="contrato" id="contrato"">
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
                        <textarea class="form-control" name="atividades" id="atividades" rows="3"></textarea>
                        <span id="atv-error" style="display:none; color:red;">Campo obrigatório!</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="requisitos">Requisitos:<span style="color: red;"></span> </label>
                        <textarea class="form-control" name="requisitos" id="requisitos" rows="3"></textarea>
                        <span id="requisitos-error" style="display:none; color:red;">Campo obrigatório!</span>

                    </div>
                </div>
        </div>
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" value="salvar" onclick="crudVaga()">Salvar</button>
                </div>
            </form>
        
    </div>
</div>
    <script src="../../src/JS/jquery-3.7.1.js"></script>
    <script src="../../src/JS/processos.js"></script>
    <script src="../../src/JS/swetalert2.js"></script>
    <script src="../src/JS/sidebar.js"></script>
   
    
</body>
</html>