<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include ('conexao.php');

    $nome  = $_POST['nome']; 
    $cnpj  = $_POST['cnpj'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $sqlCnpj =  "SELECT CNPJ FROM empresa
                WHERE CNPJ = $cnpj";



    $res = $conn->query($sqlCnpj) or die($conn->error);
    $row = $res->fetch_object();

    $qtde = $res->num_rows;
    
    if($qtde > 0){
        $response = array('success' => false, 'message' => 'Este CNPJ já está cadastrado!');
        echo json_encode($response);
        exit;
    }


    $sql = "INSERT INTO empresa (NOME, CNPJ, EMAIL, SENHA) VALUES('$nome', $cnpj, '$email', '$senha')"; 
    
    if (mysqli_query($conn, $sql)) {
        $response = array('success' => true, 'message' => 'Cadastro criado com sucesso!', 'redirect' => '../../empresas/acesso/loginempresa.html');
        echo json_encode($response);
        mysqli_close($conn);
        exit;
    } else {
        // Erro ao inserir dados
        echo "Erro ao inserir dados" . mysqli_error($conn);
    }
    mysqli_close($conn);
}


?>