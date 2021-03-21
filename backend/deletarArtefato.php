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

$consulta = "SELECT renomeavel FROM artefatos WHERE id = '$id'";
$resultado = mysqli_query($conexao,$consulta);
if($row = mysqli_fetch_assoc($resultado)){
    if($row["renomeavel"]){
        $consulta = "DELETE FROM artefatos WHERE id = '$id'";
        mysqli_query($conexao,$consulta);
        $disciplina = $_GET["disciplina"];
        header("Location: ../frontend/viewDisciplina.php?id=$disciplina");
    }
    else{
        echo "Não é possivel excluir um artefato que não seja renomeavel";
    }
}