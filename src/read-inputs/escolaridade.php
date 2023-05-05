<?php
session_start();
// Verifica se os dados foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta-se ao banco de dados
    include("../configs/conexao.php");

    $_SESSION['formulario_enviado_formacao'] = true;
    $user_id = $_SESSION['ID_USUARIO'];


    $curso_escolaridade = $_POST['curso-escolaridade'];
    $instituicao_escolaridade = $_POST['instituicao-escolaridade'];
    $contato = $_POST['contato'];
    $turno = $_POST['turno'];
    $prev_formatura = $_POST['prev-formatura'];
    $periodo = $_POST['periodo'];
    $duracao = $_POST['duracao'];
    $declaracao = $_FILES['declaracao'];

    if($declaracao != null){
        preg_match("/\.(pdf){1}$/i", $declaracao['name'], $ext);

        if($ext == true){
            $nomeArquivo = md5(uniqid(time())) . "." . $ext[1];


            $caminhoArquivo = "../../uploads/" . $nomeArquivo; 

            move_uploaded_file($declaracao['tmp_name'], $caminhoArquivo);

        }
    }

    $sqlEscolaridade = "INSERT INTO escolaridade (CURSO, INSTITUICAO, CONTATO, TURNO, PREVISAO_FORMATURA, PERIODO, DURACAO, DECLARACAO_MATRICULA, ID_USUARIO)
                        VALUES ('$curso_escolaridade', '$instituicao_escolaridade', '$contato', '$turno', '$prev_formatura', '$periodo', '$duracao', '$nomeArquivo', '$user_id')";


    if (mysqli_query($conn, $sqlEscolaridade)) {
        header ("location: ../../usuario/dados-usuario/cadastroUser.php");
    } else {
    // Erro ao inserir dados
    echo "Erro ao inserir dados" . mysqli_error($conn);
    }

// Fechar a conexão com o banco de dados
mysqli_close($conn);

}
?>