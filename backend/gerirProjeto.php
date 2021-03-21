<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: ../index.php");
}
$admin = $_SESSION["admin"];

if($admin){
    $idUser = $_SESSION['idUser'];
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    require_once("conexao.php");
    if($id == ""){
        $consuta = "INSERT INTO projeto(nome,descricao,autor) VALUE ('$nome','$descricao','$idUser')";
        mysqli_query($conexao, $consuta);
        $id = mysqli_insert_id($conexao);
        $consuta = "INSERT INTO users_projeto(projeto,user) VALUE ('$id','$idUser')";
        mysqli_query($conexao, $consuta);

    }
    else{
        $consuta = "UPDATE projeto SET nome = '$nome', descricao = '$descricao' WHERE id = '$id'";
        mysqli_query($conexao, $consuta);
    }
    header("Location: ../frontend/projetos.php");
}
else{
    echo "<h1>Você não tem permissão para criar um projeto!</h1>";
    echo "<h2><a href='../frontend/projeto.php'>Voltar</a></h2>";
}
