<?php
    session_start();

    if(empty($_SESSION)){
        header("Location: ../index.html");
    }

    include("../configs/conexao.php");

    $empresa_id = $_SESSION['ID_EMPRESA'];

    $nomeInput      = $_POST['nome']; 
    $turnoInput     = $_POST['turno']; 
    $turnoDas       = $_POST['turnoDas']; 
    $turnoAte       = $_POST['turnoAte']; 
    $cidadeInput    = $_POST['cidade']; 
    $estadoInput    = $_POST['estado']; 
    $tipoContrato   = $_POST['tipoContrato']; 
    $tipoRequisitos = $_POST['requisitos']; 
    $tipoAtv        = $_POST['atv'];
    $salario        = $_POST['salario'];

    $sql = "INSERT INTO vagas (TURNO, TURNO_DAS, TURNO_ATE, SALARIO, CIDADE, ESTADO, TIPO_CONTRATO, REQUISITOS, DESCRICAO, ID_EMPRESA, NOME)
            VALUES ('$turnoInput', '$turnoDas', '$turnoAte', $salario, '$cidadeInput', '$estadoInput', '$tipoContrato', '$tipoRequisitos', '$tipoAtv', $empresa_id, '$nomeInput')";


    if (mysqli_query($conn, $sql)) {
        $response = array('success' => true, 'message' => 'Vaga criada com sucesso!', 'redirect' => '../../empresas/vagas/cadastro-vagas.php');
        echo json_encode($response);
        mysqli_close($conn);
        exit;
    } else {
        // Erro ao inserir dados
        echo "Erro ao inserir dados" . mysqli_error($conn);
    }
    mysqli_close($conn);
?>



