<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../conexao.php");


    $user_id = $_SESSION['ID_USUARIO'];

    $nome_curso = $_POST['nome-curso'];
    $instituicao_curso = $_POST['instituicao-curso'];
    $status_curso = $_POST['status-curso'];
    $duracao_curso = $_POST['duracao-curso'];
    $n_tecnico = $_POST['n-tecnico'];


    $sql_curso = "INSERT INTO curso_extra (NOME, INSTITUICAO, STATUS, DURACAO, NIVEL_TECNICO, ID_USUARIO)
                     VALUES ('$nome_curso', '$instituicao_curso', '$status_curso', '$duracao_curso', '$n_tecnico', $user_id)";
    
    if (mysqli_query($conn, $sql_curso)) {
        header ("location: ../../usuario/dados-usuario/cadastroUser.php");
    } else {
    // Erro ao inserir dados
    echo "Erro ao inserir dados";
    }


    // Fechar a conexão com o banco de dados
    mysqli_close($conn);

}
?>