<?php
    session_start();
    
    include ('conexao.php');

    $tipo_login = $_POST['tipo_login']; // LofinUser ou LoginEmpresa

    // fazer verificações backend caso usuario desative JS


    // if(empty($_POST) or (empty($_POST['login'])) or (empty($_POST['senha']))){
    //     header ("location: ../usuario/dados-usuario/cadastroUser.php");
    // }


switch ($tipo_login){
    case 'LoginUser':

        $login = $_POST['login'];
        $senha = $_POST['senha'];
       

        $sql =  "SELECT ID_USUARIO FROM usuario
                WHERE email ='$login'
                AND senha = '$senha'";


        $res = $conn->query($sql) or die($conn->error);

        $row = $res->fetch_object();

        $qtde = $res->num_rows;

        if($qtde > 0){
            $_SESSION["ID_USUARIO"] = $row->ID_USUARIO; // Armazena o ID do usuário na sessão
            $response = array('success' => true, 'redirect' => '../../usuario/index.php');
            echo json_encode($response);
            exit;
        }
        
        $response = array('success' => false, 'message' => 'Login ou senha incorreta.');
        echo json_encode($response);
        exit;

    break;
    default:
        $login = $_POST['cnpj'];
        $senha = $_POST['senha'];

        $sql =  "SELECT ID_EMPRESA FROM empresa
        WHERE CNPJ ='$login'
        AND SENHA = '$senha'";


        $res = $conn->query($sql) or die($conn->error);

        $row = $res->fetch_object();

        $qtde = $res->num_rows;

        if($qtde > 0){
        $_SESSION["ID_EMPRESA"] = $row->ID_EMPRESA; // Armazena o ID do usuário na sessão
        $response = array('success' => true, 'redirect' => '../../empresas/index.php');
        echo json_encode($response);
        exit;
        }

        $response = array('success' => false, 'message' => 'Login ou senha incorreta.');
        echo json_encode($response);
        exit;
    break;
}
   
    
?>
