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
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $admin = isset($_POST["admin"])?$_POST["admin"]:0;
    require_once("conexao.php");
    if($id == ""){
        $consuta = "INSERT INTO users(user,email,admin,password) VALUE ('$nome','$email','$admin',md5('$senha'))";
        mysqli_query($conexao, $consuta);
        $id = mysqli_insert_id($conexao);

    }
    else{
        $consuta = "UPDATE users SET user = '$nome', email = '$email', admin = '$admin', password = md5('$senha') WHERE id = '$id'";
        mysqli_query($conexao, $consuta);
    }
    header("Location: ../frontend/novoUsuario.php");
}
else{
    echo "<h1>Você não tem permissão para criar um projeto!</h1>";
    echo "<h2><a href='../frontend/projetos.php'>Voltar</a></h2>";
}
