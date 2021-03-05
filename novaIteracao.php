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

$fase = $_GET["fase"];

mysqli_begin_transaction($conexao);

$nomes = ["I","E","C","T"];

try {
    $nome = $nomes[$fase-1];
    $consulta = "SET @iter = (SELECT COUNT(id) FROM iteracao WHERE id_fase = '$fase') + 1";
    mysqli_query($conexao, $consulta);
    $consulta = "INSERT INTO iteracao (nome,id_fase) VALUES (CONCAT('$nome',@iter),$fase)";
    mysqli_query($conexao, $consulta);
    $idIteracao = mysqli_insert_id($conexao);
    $consulta = "insert into disciplina_iteracao (id_iteracao,disciplina)  values ('$idIteracao','D1'),('$idIteracao','D2'),('$idIteracao','D3'),('$idIteracao','D4'),('$idIteracao','D5'),('$idIteracao','D6'),('$idIteracao','D7'),('$idIteracao','D8'),('$idIteracao','D9')";
    mysqli_query($conexao, $consulta);
    mysqli_commit($conexao);
    header("Location: canvas.php");
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($conexao);
    throw $e;
}

header("Location: canvas.php");
