<?php

session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}

include_once("conexao.php");
include_once("acessarProjeto.php");
acessarProjeto($_GET["projeto"],$conexao);
$projeto = $_GET["projeto"];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$fase = $_GET["id"];

$nomesFases = ["inicio","elaboracao","construcao","transicao"];

$nomeFase = $nomesFases[$fase - 1];

$consulta = "SELECT i.id FROM iteracao i INNER JOIN fase f ON(i.id_fase = f.id) WHERE f.id_projeto = '$projeto' AND f.nome LIKE '$nomeFase' ORDER by id DESC LIMIT 1";
$resultado = mysqli_query($conexao, $consulta);
$idIteracao = null;
$projeto = $_GET["projeto"];
if($row = mysqli_fetch_assoc($resultado)){
    $idIteracao = $row["id"];
}
if(!($idIteracao == 1 && $fase == 1)){
    mysqli_begin_transaction($conexao);
    try {
        $consulta = "DELETE FROM iteracao WHERE id = '$idIteracao'";
        mysqli_query($conexao, $consulta);
        mysqli_commit($conexao);
        header("Location: ../frontend/canvas.php?projeto=$projeto");
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conexao);
        throw $e;
    }
}else{
    echo "<h1>Não é possivel deletar a primeira iteração da primeira Fase!</h1>";
    echo "<h3><a href='../frontend/canvas.php?projeto=$projeto'>Voltar</a></h3>";
}

