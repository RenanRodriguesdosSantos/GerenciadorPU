<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}

include_once("conexao.php");
$id = $_POST["id"];
$nome = $_POST["nome"];
$disciplina = $_GET["disciplina"];

$consulta = "SELECT id FROM artefatos WHERE id_disciplina_iteracao = '$disciplina' AND nome LIKE '$nome'";
$resultado = mysqli_query($conexao,$consulta);

if(mysqli_num_rows($resultado) == 0){
     $consulta = "UPDATE artefatos SET nome = '$nome' WHERE id = '$id'";
     mysqli_query($conexao,$consulta);
     header("Location: ../frontend/viewDisciplina.php?id=$disciplina");
}
else{
    echo "Não é possivel Salvar dois artefatos com o mesmo nome na mesma disciplina!";
}
