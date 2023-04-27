<?php
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../conexao.php");

    $empresa = $_POST['empresa'];
    $cargo = $_POST['cargo'];
    $inicio = $_POST['data-inicio'];
    $fim = $_POST['data-fim'];
    $tipo_contrato = $_POST['tipo_contrato'];
    $atividades = $_POST['atividades'];
}
?>