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
    $ID_curso = $_POST['idCurso'];

    $sqlUpdate = "UPDATE curso_extra SET
                  NOME = '$nome_curso',
                  INSTITUICAO = '$instituicao_curso',
                  STATUS = '$status_curso',
                  DURACAO = '$duracao_curso',
                  NIVEL_TECNICO = '$n_tecnico'
                  WHERE ID_USUARIO = '$user_id'
                  AND ID_CURSO = '$ID_curso'";

    if (mysqli_query($conn, $sqlUpdate)) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        $response = array('success' => true, 'message' => 'Curso editado com sucesso!', 'redirect' => '../../usuario/dados-usuario/cursoUser.php');
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