<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include_once("conexao.php");

$fase = $_GET["id"];
mysqli_begin_transaction($conexao);
try {
    $consulta = "SET @iter = (SELECT id FROM iteracao WHERE id_fase = '$fase' ORDER by id DESC LIMIT 1)";
    mysqli_query($conexao, $consulta);
    $consulta = "DELETE FROM iteracao WHERE id = @iter";
    mysqli_query($conexao, $consulta);
    mysqli_commit($conexao);
    header("Location: canvas.php");
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($conexao);
    throw $e;
}
