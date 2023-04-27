<?php
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../conexao.php");

    $nome_curso = $_POST['nome-curso'];
    $instituicao_curso = $_POST['instituicao-curso'];
    $status_curso = $_POST['status-curso'];
    $duracao_curso = $_POST['duracao-curso'];
    $n_tecnico = $_POST['n-tecnico'];
}
?>