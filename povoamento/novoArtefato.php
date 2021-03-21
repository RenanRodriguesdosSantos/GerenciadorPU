<?php

require_once("conexao.php");

$disciplina = $_GET["disciplina"];
$artefato = $_POST["artefato"];

$consulta = "INSERT INTO artefatos(nome, id_disciplina_iteracao) VALUE ('$artefato','$disciplina')";

mysqli_query($conexao,$consulta);

header("Location: listaArtefato.php?disciplina=$disciplina");