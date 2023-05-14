<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");


    $user_id = $_SESSION['ID_USUARIO'];

    $nome_curso = $_POST['nomeCurso'];
    $instituicao_curso = $_POST['instituicaoCurso'];
    $status_curso = $_POST['statusCurso'];
    $duracao_curso = $_POST['duracaoCurso'];
    $n_tecnico = $_POST['nivelTecnico'];


    $sql_curso = "INSERT INTO curso_extra (NOME, INSTITUICAO, STATUS, DURACAO, NIVEL_TECNICO, ID_USUARIO)
                     VALUES ('$nome_curso', '$instituicao_curso', '$status_curso', '$duracao_curso', '$n_tecnico', $user_id)";
    
    if (mysqli_query($conn, $sql_curso)) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        $response = array('success' => true, 'message' => 'Curso adicionado!', 'redirect' => '../../usuario/dados-usuario/cursoUser.php');
        echo json_encode($response);
        mysqli_close($conn);
        exit;
    } else {
        // Erro ao inserir dados
        echo "Erro ao inserir dados" . mysqli_error($conn);
    }


    // Fechar a conexão com o banco de dados
    mysqli_close($conn);

}
?>