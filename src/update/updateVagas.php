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
    $idVaga         = $_POST['idVaga'];

    $sql = "UPDATE vagas SET 
            TURNO = '$turnoInput',
            TURNO_DAS = '$turnoDas',
            TURNO_ATE = '$turnoAte',
            SALARIO = $salario,
            CIDADE = '$cidadeInput',
            ESTADO = '$estadoInput',
            TIPO_CONTRATO = '$tipoContrato',
            REQUISITOS = '$tipoRequisitos',
            DESCRICAO = '$tipoAtv',
            NOME = '$nomeInput'
            WHERE ID_EMPRESA = $empresa_id
            AND ID_VAGA = $idVaga";


    if (mysqli_query($conn, $sql)) {
        $response = array('success' => true, 'message' => 'Vaga editada com sucesso!', 'redirect' => '../../empresas/vagas/editar-vagas.php');
        echo json_encode($response);
        mysqli_close($conn);
        exit;
    } else {
        // Erro ao inserir dados
        echo "Erro ao inserir dados" . mysqli_error($conn);
    }
    mysqli_close($conn);
?>