<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../../src/configs/conexao.php");

    $idVaga = $_POST['idVaga']; 
    $user_id = $_SESSION['ID_USUARIO'];


    $sql = "INSERT INTO usuario_vagas (ID_USUARIO, ID_VAGA) VALUES ($user_id, $idVaga)";

    if (mysqli_query($conn, $sql)) {
        $response = array('success' => true, 'message' => 'Você se candidatou para vaga com sucesso!', 'redirect' => '../usuario/vagas.php');
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