<?php

require_once("conexao.php");

$artefato = $_GET["artefato"];
$conteudo = $_POST["conteudo"];

$consulta = "INSERT INTO conteudo(titulo, id_artefato) VALUE ('$conteudo','$artefato')";

mysqli_query($conexao,$consulta);

header("Location: listaConteudo.php?artefato=$artefato");