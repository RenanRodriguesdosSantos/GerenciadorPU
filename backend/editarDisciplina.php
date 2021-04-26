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

$tempo  = $_POST["tempo"];
$id = $_GET["id"];


$consulta = "UPDATE disciplina_iteracao SET tempo = '$tempo' WHERE id = '$id'";
mysqli_query($conexao, $consulta);

header("Location: ../frontend/viewDisciplina.php?id=$id&projeto=$projeto");

