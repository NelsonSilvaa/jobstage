<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");

    $user_id = $_SESSION['ID_USUARIO'];

    $empresa = $_POST['empresa'];
    $cargo = $_POST['cargo'];
    $dataInicio = $_POST['dataInicio'];
    $dataFim = $_POST['dataFim'];
    $tipoContrato = $_POST['tipoContrato'];
    $atividades = $_POST['atividades'];
    $ID_EXP = $_POST['ID_EXP'];

    $sqlUpdate = "UPDATE experiencia SET
                  EMPRESA = '$empresa',
                  CARGO = '$cargo',
                  INICIO = '$dataInicio',
                  FIM = '$dataFim',
                  TIPO_CONTRATO = '$tipoContrato',
                  ATIVIDADES = '$atividades'
                  WHERE ID_USUARIO = '$user_id'
                  AND ID_EXPERIENCIA = '$ID_EXP'";

    if (mysqli_query($conn, $sqlUpdate)) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        $response = array('success' => true, 'message' => 'Experiência editada com sucesso!', 'redirect' => '../../usuario/dados-usuario/expuser.php');
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