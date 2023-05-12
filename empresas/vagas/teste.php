<?php 

include("../../src/configs/conexao.php");

//Selecionando as vagas da empresa com ID = 2
$sql = "SELECT DISTINCT V.ID_VAGA, V.NOME FROM vagas as V
        INNER JOIN empresa as E
        on E.ID_EMPRESA = V.ID_EMPRESA
        WHERE E.ID_EMPRESA = 2";
$result = $conn->query($sql);

//Array para armazenar as vagas selecionadas
$vagas = array();

//Percorrendo as vagas selecionadas
while ($row = $result->fetch_assoc()) {
    //Selecionando os usuários que se candidataram a essa vaga
    $sql2 = "SELECT DISTINCT U.ID_USUARIO, U.NOME FROM usuario_vagas as UV
            INNER JOIN usuario as U
            ON U.ID_USUARIO = UV.ID_USUARIO
            WHERE UV.ID_VAGA = ".$row['ID_VAGA'];
    $result2 = $conn->query($sql2);

    //Array para armazenar os usuários candidatos
    $candidatos = array();

    //Percorrendo os usuários candidatos
    while ($row2 = $result2->fetch_assoc()) {
        //Adicionando o usuário candidato ao array, se ele ainda não estiver lá
        if (!in_array($row2['ID_USUARIO'], $candidatos)) {
            $candidatos[] = $row2['NOME'];
        }
    }

    //Adicionando a vaga e o array de usuários candidatos ao array de vagas selecionadas
    $vagas[] = array('vaga' => $row['NOME'], 'candidatos' => $candidatos);
}

//Exibindo as vagas selecionadas e seus respectivos arrays de usuários candidatos
foreach ($vagas as $vaga) {
    echo "Vaga: ".$vaga['vaga']."<br>";
    echo "Candidatos: ";
    foreach ($vaga['candidatos'] as $candidato) {
        echo $candidato.", ";
    }
    echo "<br><br>";
}

//Fechando a conexão com o banco de dados
$conn->close();
?>