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

$consulta = "SELECT renomeavel FROM artefatos WHERE id = '$id'";
$resultado = mysqli_query($conexao,$consulta);
if($row = mysqli_fetch_assoc($resultado)){
    if($row["renomeavel"]){
        $consulta = "DELETE FROM artefatos WHERE id = '$id'";
        mysqli_query($conexao,$consulta);
        $disciplina = $_GET["disciplina"];
        header("Location: ../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto");
    }
    else{
        echo "<h1>Não é possivel excluir um artefato que não seja renomeavel</h1>";
        echo "<h2><a href='../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto'>Voltar</a></h2>";
    }
}