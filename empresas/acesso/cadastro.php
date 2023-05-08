<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../../src/configs/conexao.php");

    $nome = $_POST['nomeEmpresa'];
    $email = $_POST['email'];
    $cnpj = $_POST['cnpj'];
    $senha = $_POST['senha01'];
    $senhaConfirm = $_POST['senha02'];

    // verifica se conta já existe
    $sqlExiste = "SELECT CNPJ FROM empresa
                  WHERE CNPJ = $cnpj";
    $resultado = mysqli_query($conn, $sqlExiste);

    if (mysqli_num_rows($resultado) > 0) {
            $_SESSION['cnpj_existe'] = true;
            header ("location: cadastro-empresa.php");
    }else{
            $sqlInsert = "INSERT INTO empresa (NOME, CNPJ, EMAIL, SENHA) VALUES ('$nome', $cnpj , '$email','$senha')";
    
            if (mysqli_query($conn, $sqlInsert)) {
                header ("location: ../../usuario/dados-usuario/cadastroUser.php");
            } else {
            // Erro ao inserir dados
            echo "Erro ao inserir dados";
            }
        
            // Fechar a conexão com o banco de dados
            mysqli_close($conn);
    }
}

?>