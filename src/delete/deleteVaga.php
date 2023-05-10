<?php
    session_start();

    if(empty($_SESSION)){
        header("Location: ../index.html");
    }

    include("../configs/conexao.php");

    $empresa_id = $_SESSION['ID_EMPRESA'];

    $idVaga = $_POST['idVaga'];


    $sql = "DELETE FROM vagas 
            WHERE ID_EMPRESA = $empresa_id 
            AND ID_VAGA = $idVaga";

    if (mysqli_query($conn, $sql)) {
        $response = array('success' => true, 'redirect' => '../../empresas/vagas/editar-vagas.php');
        echo json_encode($response);
        mysqli_close($conn);
        exit;
    } else {
        // Erro ao inserir dados
        echo "Erro ao inserir dados" . mysqli_error($conn);
    }
    mysqli_close($conn);