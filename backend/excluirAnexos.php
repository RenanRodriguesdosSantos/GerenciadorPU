<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}
include_once("conexao.php");

$anexos = $_POST["anexos"];
$id = $_GET["id"];

foreach ($anexos as $value) {
    $consulta = "DELETE FROM anexos WHERE id = '$value'";
    $resultado = mysqli_query($conexao, $consulta);
}

header("Location: ../frontend/viewArtefato.php?id=$id");