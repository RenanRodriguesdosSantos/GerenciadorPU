<?php

session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include_once("conexao.php");

$fase = $_GET["id"];

$consulta = "SELECT id FROM iteracao WHERE id_fase = '$fase' ORDER by id DESC LIMIT 1";
$resultado = mysqli_query($conexao, $consulta);
$idIteracao = null;
if($row = mysqli_fetch_assoc($resultado)){
    $idIteracao = $row["id"];
}
if(!($idIteracao == 1 && $fase == 1)){
    mysqli_begin_transaction($conexao);
    try {
        $consulta = "DELETE FROM iteracao WHERE id = '$idIteracao'";
        mysqli_query($conexao, $consulta);
        mysqli_commit($conexao);
        header("Location: ../frontend/canvas.php");
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conexao);
        throw $e;
    }
}else{
    echo "<h1>Não é possivel deletar a primeira iteração da primeira Fase!</h1>";
    echo "<h3><a href='../frontend/canvas.php'>Voltar</a></h3>";
}

