<?php

    include('../../src/configs/conexao.php');

    $id_usuario = $_GET['id_usuario'];

    
    $sql = "SELECT * FROM usuario
            WHERE ID_USUARIO = $id_usuario";
    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    echo $row['ID_USUARIO'];



?>