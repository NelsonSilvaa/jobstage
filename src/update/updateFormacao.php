<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../conexao.php");

    $user_id = $_SESSION['ID_USUARIO'];
    $curso = $_POST['curso'];
    $instituicao = $_POST['instituicao'];
    $nivel = $_POST['nivel'];
    $duracao = $_POST['duracao'];
    $status = $_POST['status'];
   

 $sqlUpdate = " UPDATE formacao SET 
                CURSO = '$curso', 
                INSTITUICAO = '$instituicao', 
                NIVEL = '$nivel', 
                DURACAO = '$duracao', 
                STATUS = '$status' 
                WHERE ID_USUARIO = '$user_id'";
    
    if (mysqli_query($conn, $sqlUpdate)) {
        header ("location: ../../usuario/dados-usuario/cadastroUser.php");
    } else {
    // Erro ao inserir dados
    echo "Erro ao atualizar dados";
    }


    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
}




?>