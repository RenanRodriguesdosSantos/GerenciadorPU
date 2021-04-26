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

$id = $_GET["id"];

$consulta = "DELETE FROM subconteudo WHERE id = $id";
mysqli_query($conexao,$consulta);

$artefato = $_GET["artefato"];
$projeto = $_GET["projeto"];
header("Location: ../frontend/editArtefato.php?id=$artefato&projeto=$projeto");