<?php
    session_start();

    if(empty($_POST) or (empty($_POST['usuario'])) or (empty($_POST['senha']))){
        header ("location: ../usuario/dados-usuario/cadastroUser.php");
    }

    include ('conexao.php');

    $usuario = $_POST['usuario'];
    $senha   = $_POST['senha'];

    $sql =  "SELECT * FROM usuario
            WHERE login ='{$usuario}'
            AND senha = '{$senha}'";


    $res = $conn->query($sql) or die($conn->error);


    $row = $res->fetch_object();

    $qtde = $res->num_rows;

    if($qtde > 0){
        $_SESSION["usuario"] = $usuario;
        header ("location: ../usuario/dados-usuario/cadastroUser.php");
    }else{
        echo "<script> alert('erro') </scrip>";
        header ("location: ../index.php");
    }

?>