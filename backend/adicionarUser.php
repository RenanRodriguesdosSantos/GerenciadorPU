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

    $projeto = $_GET["projeto"];
    $user = $_POST["usuario"];
    require_once("conexao.php");
    $consuta = "INSERT INTO users_projeto(projeto,user) VALUE ('$projeto','$user')";
    mysqli_query($conexao, $consuta);
    header("Location: ../frontend/projetos.php");
}
else{
    echo "<h1>Você não tem permissão para adicionar um usuario!</h1>";
    echo "<h2><a href='../frontend/projeto.php'>Voltar</a></h2>";
}