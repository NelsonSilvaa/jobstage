<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");

    $user_id = $_SESSION['ID_USUARIO'];

    $curso = $_POST['curso'];
    $instituicao = $_POST['instituicao'];
    $nivel = $_POST['nivel'];
    $duracao = $_POST['duracao'];
    $status = $_POST['status'];
    $numeroIdFormacao = $_POST['id_curso'];

    $sqlUpdate = " UPDATE formacao SET 
                    CURSO = '$curso', 
                    INSTITUICAO = '$instituicao', 
                    NIVEL = '$nivel', 
                    DURACAO = '$duracao', 
                    STATUS = '$status' 
                    WHERE ID_USUARIO = '$user_id'
                    AND ID_FORMACAO = '$numeroIdFormacao'";


    if (mysqli_query($conn, $sqlUpdate)) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        $response = array('success' => true, 'message' => 'Formação editada com sucesso!', 'redirect' => '../../usuario/dados-usuario/formacaoUser.php');
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