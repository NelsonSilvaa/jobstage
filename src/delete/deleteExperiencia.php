<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");

   
    $id_linha = $_POST['id_linha'];

    $sql_delete = "DELETE FROM experiencia WHERE ID_EXPERIENCIA = '$id_linha'";

    if (mysqli_query($conn, $sql_delete)) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        $response = array('success' => true, 'redirect' => '../../usuario/dados-usuario/expUser.php');
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