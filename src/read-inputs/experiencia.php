<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");

    $user_id = $_SESSION['ID_USUARIO'];
    $empresa = $_POST['empresa'];
    $cargo = $_POST['cargo'];
    $inicio = $_POST['data-inicio'];
    $fim = $_POST['data-fim'];
    $tipo_contrato = $_POST['tipo_contrato'];
    $atividades = $_POST['atividades'];

    $sql_exp = "INSERT INTO experiencia (EMPRESA, CARGO, INICIO, FIM, TIPO_CONTRATO, ATIVIDADES, ID_USUARIO)
                     VALUES ('$empresa', '$cargo', '$inicio', '$fim', '$tipo_contrato','$atividades', '$user_id')";
    
    if (mysqli_query($conn, $sql_exp)) {
        header ("location: ../../usuario/dados-usuario/cadastroUser.php");
    } else {
    // Erro ao inserir dados
    echo "Erro ao inserir dados ";
    }


    // Fechar a conexão com o banco de dados
    mysqli_close($conn);

}
?>