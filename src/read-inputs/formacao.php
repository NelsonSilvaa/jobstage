<?php
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../conexao.php");

    $curso = $_POST['curso'];
    $instituicao = $_POST['instituicao'];
    $nivel = $_POST['nivel'];
    $duracao = $_POST['duracao'];
    $status = $_POST['status'];
}
?>