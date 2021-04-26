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
    $consuta = "SELECT id FROM users_projeto WHERE projeto = '$projeto' AND user = '$user'";
    $resutltado = mysqli_query($conexao, $consuta);
    if(mysqli_num_rows($resutltado) == 0){
        $consuta = "INSERT INTO users_projeto(projeto,user) VALUE ('$projeto','$user')";
        mysqli_query($conexao, $consuta);
        header("Location: ../frontend/projetos.php");
    }
    else{

        echo "<h1>Usuário está no projeto!</h1>";
        echo "<h2><a href='../frontend/projetos.php'>Voltar</a></h2>";
    }
}
else{
    echo "<h1>Você não tem permissão para adicionar um usuario!</h1>";
    echo "<h2><a href='../frontend/projetos.php'>Voltar</a></h2>";
}