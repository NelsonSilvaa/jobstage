<?php
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../conexao.php");

    $curso_escolaridade = $_POST['curso-escolaridade'];
    $instituicao_escolaridade = $_POST['instituicao-escolaridade'];
    $contato = $_POST['contato'];
    $turno = $_POST['turno'];
    $prev_formatura = $_POST['prev-formatura'];
    $periodo = $_POST['periodo'];
    $duracao = $_POST['duracao'];
    $declaracao = $_FILES['declaracao']['name'];
}
?>