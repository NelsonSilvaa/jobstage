<?php 
// session_start();

//     if(empty($_SESSION)){
//         header("Location: ../../index.php");
//     }
//     include("../src/configs/conexao.php");

//     $user_id = $_SESSION['ID_USUARIO'];

// ?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/layout.css">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <script src="../JS/jquery-3.6.4.js"></script>
</head>
<body>
<header>
    <h1 style="text-align: center; color:white; font-family: Ubuntu;">JOB'STAGE</h1>
</header>

<div class="sec-dados">
    
  <div class="navegacao">
      <nav class="navbar">
      <ul>
          <li><a href="../index.html">Inicio</a></li>
          <li><a href="cadastroUser.php">Dados</a></li>
          <li><a href="../vagas.php">Vagas</a></li>
          <li><a href="../candidaturas.php">Candidaturas</a></li>
          <li><a href="curriculo.php">Funcionários</a></li>
          <li style="background-color: red;"> <a href="../src/configs/logout.php">Sair</a></li>
      </ul>
  </div>

  <div class="container-dados">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" id="vagas-tab" data-toggle="tab" href="#vagas" role="tab" aria-controls="vagas" aria-selected="false">Vagas</a>
          </li>
          <li class="nav-item">
              <a class="nav-link " id="minhasVagas-tab" data-toggle="tab" href="#minhasVagas" role="tab" aria-controls="minhasVagas" aria-selected="false">Minhas vagas</a>
          </li>
      </ul>
      <div class="card">
        <div class="card-body">
          <div class="tab-content" id="vagas">
        <!-- VAGAS -->
            <div class="tab-pane fade show active" id="vagas" role="tabpanel" aria-labelledby="vagas-tab">
                <form>
                  <div class="form-row">
                      <div class="col">
                          <label for="nomeVaga">Nome da vaga<span style="color: red;">*</span> </label>
                          <input type="text" class="form-control" placeholder="Nome da vaga" name="nomeVaga" id="nomeVaga" required>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="col">
                          <label for="turno">Turno<span style="color: red;">*</span> </label>
                          <select type="text" class="form-control" placeholder="abc" name="turno" id="turno">
                              <option value=""></option>
                              <option value="Manhã"></option>
                              <option value="Tarde"></option>
                              <option value="Noite"></option>
                          </select>
                      </div>
                      <div class="col">
                          <label for="turnoDas">Das<span style="color: red;">*</span> </label>
                          <input type="time" class="form-control"  name="turnoDas" id="turnoDas" required>
                      </div>
                      <div class="col">
                          <label for="turnoAte">Até<span style="color: red;">*</span> </label>
                          <input type="time" class="form-control" name="turnoAte" id="turnoAte" required>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="col">
                          <label for="cidade">Cidade<span style="color: red;">*</span> </label>
                          <input type="text" class="form-control" placeholder="Cidade" name="cidade" id="cidade" required>
                      </div>
                      <div class="col">
                          <label for="estado">Estado<span style="color: red;">*</span> </label>
                          <select type="text" class="form-control" placeholder="abc" name="estado" id="estado" required>
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
                  <div class="form-row">
                      <div class="col">
                          <label for="salario">Salário<span style="color: red;"></span> </label>
                          <input type="text" class="form-control" placeholder="Salário" name="salario" id="salario">
                      </div>
                      <div class="col">
                          <label for="contrato">Tipo de contrato<span style="color: red;">*</span> </label>
                          <select type="text" class="form-control" placeholder="" name="tipo_contrato" id="tipo_contrato" value="'.$expQuery['TIPO_CONTRATO'].'">
                              <option value=""></option>
                              <option value="CLT">CLT</option>
                              <option value="PJ">PJ</option>
                              <option value="estagio">Estágio</option>
                              <option value="temporario">Temporário</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="col">
                          <label for="atividades">Atividades<span style="color: red;">*</span> </label>
                          <textarea class="form-control" name="atividades" id="atividades" rows="3" required></textarea>
                      </div>
                  </div>
                  <div class="form-row">
                    <div class="col">
                        <label for="requisitos">Requisitos:<span style="color: red;"></span> </label>
                        <textarea class="form-control" name="requisitos" id="requisitos" rows="3" required></textarea>
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
    <script 
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-kSpN/7CfdBjN9+RY5DhN5Hz5zr+ZnysK8W1ufX0ZN0SPR20BpZiDgmWwfdKvSGtl"
        crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>