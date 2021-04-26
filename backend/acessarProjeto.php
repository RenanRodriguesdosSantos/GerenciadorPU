<?php

function acessarProjeto($idProjeto,$conexao){
    $idUser = $_SESSION['idUser'];
    $consulta = "SELECT p.nome FROM users_projeto us INNER JOIN projeto p ON (us.projeto = p.id) WHERE user = '$idUser' AND projeto = '$idProjeto'";
    $resultado = mysqli_query($conexao,$consulta);
    if(mysqli_num_rows($resultado) == 0){
        echo "<h1>Você não tem permissão para acessar este projeto</h1>";
        echo "<h2><a href='../frontend/projetos.php'>Voltar</a></h2>";
        exit();
    }
    else{
        $row = mysqli_fetch_assoc($resultado);
        return $row["nome"];
    }
}