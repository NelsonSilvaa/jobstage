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
   

 $sql_formacao = "INSERT INTO formacao (CURSO, INSTITUICAO, NIVEL, DURACAO, STATUS, ID_USUARIO)
                     VALUES ('$curso', '$instituicao', '$nivel', '$duracao', '$status', $user_id)";
    
    if (mysqli_query($conn, $sql_formacao)) {
        header ("location: ../../usuario/dados-usuario/cadastroUser.php");
    } else {
    // Erro ao inserir dados
    echo "Erro ao inserir dados";
    }


    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
}




?>


















// CODIGO COM TABELA DE RELACIONAMENTO ANTIGA - GUARDAR POR PRECAOUÇAÕ


// $id_formacao = $_SESSION['ID_FORMACAO'];
    // if (mysqli_query($conn, $sql_formacao)) {
    //     // Obtém o ID gerado automaticamente pelo banco de dados
    //     $id_formacao = mysqli_insert_id($conn);
    //     echo "inserido com sucesso";
    // } else {
    //     // Se ocorrer um erro, desfaz a transação e exibe uma mensagem de erro
    //     mysqli_rollback($conn);
    // die("Erro ao inserir formação: " . mysqli_error($conn));
    // }


// relaciona a tabela usuario e formacao
    // $sql_usuario_formacao = "INSERT INTO usuario_formacao (ID_USUARIO, ID_FORMACAO) VALUES ('$user_id', '$id_formacao')";
    // if (!mysqli_query($conn, $sql_usuario_formacao)) {
    //     // Se ocorrer um erro, desfaz a transação e exibe uma mensagem de erro
    //     mysqli_rollback($conn);
    //     die("Erro ao relacionar usuário com formação: " . mysqli_error($conn));
    // }