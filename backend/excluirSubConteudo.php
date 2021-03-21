<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}

include_once("conexao.php");
$id = $_GET["id"];

$consulta = "DELETE FROM subconteudo WHERE id = $id";
mysqli_query($conexao,$consulta);

$artefato = $_GET["artefato"];
header("Location: ../frontend/editArtefato.php?id=$artefato");