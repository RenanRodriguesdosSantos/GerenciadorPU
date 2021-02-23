<?php

include_once("conexao.php");

$anexos = $_POST["anexos"];
$id = $_GET["id"];

foreach ($anexos as $value) {
    $consulta = "SELECT nome FROM artefatos WHERE id = '$value'";
    $resultado = mysqli_query($conexao, $consulta);
    if($row = mysqli_fetch_assoc($resultado)){

        if(unlink("uploads/".$row["nome"])){
            $consulta = "DELETE FROM artefatos WHERE id = '$value'";
            mysqli_query($conexao, $consulta);
        }
    }
}

header("Location: viewDisciplina.php?id=$id");