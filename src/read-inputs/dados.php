<?php
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../conexao.php");

     
// Verifica se foi enviado um POST

    // Lê os valores dos campos
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $data_nasc = $_POST['data-nasc'];
    $idade = $_POST['idade'];
    $nome_mae = $_POST['nome-mae'];
    $nome_pai = $_POST['nome-pai'];
    $rg = $_POST['rg'];
    $data_emissao = $_POST['data-emissao'];
    $orgao_emissor = $_POST['orgao-emissor'];
    $estado = $_POST['estado'];
   
    echo "$nome"; 
    
    
    // Faça algo com os valores lidos
    // ...
}
?>







    <!-- // query que faz o join de todas as tabelas do banco
    $sql_join = "SELECT * from usuario as U
    inner join usuario_formacao as UF
    on U.ID_USUARIO = UF.ID_USUARIO
    INNER JOIN FORMACAO AS F
    ON F.ID_FORMACAO = UF.ID_FORMACAO
    INNER JOIN USUARIO_EXPERIENCIA AS UE
    ON UE.ID_USUARIO = U.ID_USUARIO
    INNER JOIN EXPERIENCIA AS E
    ON E.ID_EXPERIENCIA = UE.ID_EXPERIENCIA
    INNER JOIN USUARIO_ESCOLARIDADE AS UES
    ON UES.ID_USUARIO = U.ID_USUARIO
    INNER JOIN ESCOLARIDADE AS ES
    ON ES.ID_ESCOLARIDADE = UES.ID_ESCOLARIDADE
    INNER JOIN USUARIO_CURSO_EXTRA AS UCX
    ON UCX.ID_USUARIO = U.ID_USUARIO
    INNER JOIN CURSO_EXTRA AS CX
    ON CX.ID_CURSO = UCX.ID_CURSO_EXTRA";


    // fazer insert inserindo as chaves estrangeiras de acordo com o id do usuario 

    // Prepara a consulta SQL
    $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";











    // Executa a consulta SQL
    if (mysqli_query($conn, $sql)) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . mysqli_error($conn);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);
}
?> -->