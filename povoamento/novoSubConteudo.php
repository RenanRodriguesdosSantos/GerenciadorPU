<?php

require_once("conexao.php");

$subconteudo = $_POST["subconteudo"];
$conteudo = $_GET["conteudo"];

$consulta = "INSERT INTO subconteudo(titulo, id_conteudo) VALUE ('$subconteudo','$conteudo')";
mysqli_query($conexao,$consulta);

header("Location: listaSubConteudo.php?conteudo=$conteudo");