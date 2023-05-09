<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");

    // leitura do tipo de formulario que será editdo
    $tipo = $_POST['TIPO']; 

    $user_id = $_SESSION['ID_USUARIO'];

    switch($tipo){
        case 'EDITAR-DADOS';

        break;
        case 'EDITAR-FORMACAO';

           
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

            $empresa = $_POST['empresa'];
            $cargo = $_POST['cargo'];
            $inicio = $_POST['data-inicio'];
            $fim = $_POST['data-fim'];
            $tipo_contrato = $_POST['tipo_contrato'];
            $atividades = $_POST['atividades'];
            $numeroIdExperiencia = $_POST['ID_EXP'];
    
            $sqlUpdate = "UPDATE experiencia SET
                          EMPRESA = '$empresa',
                          CARGO = '$cargo',
                          INICIO = '$inicio',
                          FIM = '$fim',
                          TIPO_CONTRATO = '$tipo_contrato',
                          ATIVIDADES = '$atividades'
                          WHERE ID_USUARIO = '$user_id'
                          AND ID_EXPERIENCIA = '$numeroIdExperiencia'";
        
            if (mysqli_query($conn, $sqlUpdate)) {
                header ("location: ../../usuario/dados-usuario/cadastroUser.php");
            } else {
            // Erro ao inserir dados
            echo "Erro ao inserir dados " . mysqli_error($conn);
            }
        
        
            // Fechar a conexão com o banco de dados
            mysqli_close($conn);


        break;
        case 'EDITAR-ESCOLARIDADE';

        break;
        case 'EDITAR-CURSO';

            $nome_curso = $_POST['nome-curso'];
            $instituicao_curso = $_POST['instituicao-curso'];
            $status_curso = $_POST['status-curso'];
            $duracao_curso = $_POST['duracao-curso'];
            $n_tecnico = $_POST['n-tecnico'];
            $numeroIdCurso = $_POST['ID_CURSO'];
        
            $sqlUpdate = "UPDATE curso_extra SET
                          NOME = '$nome_curso',
                          INSTITUICAO = '$instituicao_curso',
                          STATUS = '$status_curso',
                          DURACAO = '$duracao_curso',
                          NIVEL_TECNICO = '$n_tecnico'
                          WHERE ID_USUARIO = '$user_id'
                          AND ID_CURSO = '$numeroIdCurso'";
            
            if (mysqli_query($conn, $sqlUpdate)) {
                header ("location: ../../usuario/dados-usuario/cadastroUser.php");
            } else {
            // Erro ao inserir dados
            echo "Erro ao inserir dados";
            }
        
        
            // Fechar a conexão com o banco de dados
            mysqli_close($conn);
        case 'EDITAR-VAGA':

        break;

            
    }
}




?>