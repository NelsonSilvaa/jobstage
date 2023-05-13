<?php
 session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");
    // pega o id do usuario logado na sessão no banco de dados
    $user_id = $_SESSION['ID_USUARIO'];
    
    // variavel para bloquear ID após usuario enviar dados pela primeira vez
    $_SESSION['formulario_enviado_dados'] = true;

    // Lê os valores dos campos
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nasc = $_POST['dataNsc'];
    $estadoCivil = $_POST['estdoCivil'];
    $telefone = $_POST['telefone'];
    $linkedin = $_POST['linkedin'];
    $sobre = $_POST['sobre'];
   
    // atualiza a dabela para inserir dados no banco de dados
    $sql= " UPDATE usuario SET 
            NOME = '$nome', 
            EMAIL = '$email', 
            DATA_NASC = '$data_nasc', 
            ESTADO_CIVIL = '$estadoCivil',
            TELEFONE = $telefone,
            LINKEDIN = '$linkedin',
            SOBRE = '$sobre'
            WHERE ID_USUARIO = '$user_id'";

    if (mysqli_query($conn, $sql)) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        $response = array('success' => true, 'message' => 'Dados salvos!', 'redirect' => '../../usuario/dados-usuario/dadosUser.php');
        echo json_encode($response);
        mysqli_close($conn);
        exit;
    } else {
        // Erro ao inserir dados
        echo "Erro ao inserir dados" . mysqli_error($conn);
    }
mysqli_close($conn);
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