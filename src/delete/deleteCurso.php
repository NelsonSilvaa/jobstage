<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");

   
    $id_linha = $_POST['id_linha'];

    $sql_delete = "DELETE FROM curso_extra WHERE ID_CURSO = '$id_linha'";

    if (mysqli_query($conn, $sql_delete)) {
        header ("location: ../../usuario/dados-usuario/cadastroUser.php");
    } else {
    // Erro ao inserir dados
    echo "Erro ao inserir dados"  . mysqli_error($conn);
    }


// Fechar a conexão com o banco de dados
mysqli_close($conn);

}
?>