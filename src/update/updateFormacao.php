<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../conexao.php");

    // leitura do tipo de formulario que será editdo
    $tipo = $_POST['TIPO']; 

    switch($tipo){
        case 'EDITAR-DADOS';

        break;
        case 'EDITAR-FORMACAO';

            $user_id = $_SESSION['ID_USUARIO'];
            $curso = $_POST['curso'];
            $instituicao = $_POST['instituicao'];
            $nivel = $_POST['nivel'];
            $duracao = $_POST['duracao'];
            $status = $_POST['status'];
            $numeroIdFormacao = $_POST['ID_FORM'];


            $sqlUpdate = " UPDATE formacao SET 
                            CURSO = '$curso', 
                            INSTITUICAO = '$instituicao', 
                            NIVEL = '$nivel', 
                            DURACAO = '$duracao', 
                            STATUS = '$status' 
                            WHERE ID_USUARIO = '$user_id'
                            AND ID_FORMACAO = '$numeroIdFormacao'";
            
            if (mysqli_query($conn, $sqlUpdate)) {
                header ("location: ../../usuario/dados-usuario/cadastroUser.php");
            } else {
            // Erro ao inserir dados
            echo "Erro ao atualizar dados";
            }
            // Fechar a conexão com o banco de dados
            mysqli_close($conn);

        break;
        case 'EDITAR-EXPERIENCIA';

        break;
        case 'EDITAR-ESCOLARIDADE';

        break;
        case 'EDITAR-CURSO';

        break;
        default;
            
        break;

            
    }
}




?>