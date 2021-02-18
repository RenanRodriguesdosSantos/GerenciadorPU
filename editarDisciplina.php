<?php

include_once("conexao.php");

$tempo  = $_POST["tempo"];
$id = $_GET["id"];
$resumo = $_POST["resumo"];
$texto = $_POST["texto"];

$consulta = "UPDATE disciplina_iteracao SET tempo = '$tempo', resumo = '$resumo', texto = '$texto' WHERE id = '$id'";
mysqli_query($conexao, $consulta);

header("Location: viewDisciplina.php?id=$id");

