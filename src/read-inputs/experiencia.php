<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");

    $user_id = $_SESSION['ID_USUARIO'];
    $empresa = $_POST['empresa'];
    $cargo = $_POST['cargo'];
    $inicio = $_POST['dataInicio'];
    $fim = $_POST['dataFim'];
    $tipo_contrato = $_POST['tipoContrato'];
    $atividades = $_POST['atividades'];

    $sql_exp = "INSERT INTO experiencia (EMPRESA, CARGO, INICIO, FIM, TIPO_CONTRATO, ATIVIDADES, ID_USUARIO)
                     VALUES ('$empresa', '$cargo', '$inicio', '$fim', '$tipo_contrato','$atividades', '$user_id')";

    if (mysqli_query($conn, $sql_exp)) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        $response = array('success' => true, 'message' => 'Experiência adicionada!', 'redirect' => '../../usuario/dados-usuario/expUser.php');
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