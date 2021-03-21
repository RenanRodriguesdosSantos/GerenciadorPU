<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}

include_once("conexao.php");
$id = $_SESSION["idUser"];
$senhaAtual = $_POST["senhaAtual"];

$consulta = "SELECT * FROM users WHERE id = '$id' and password LIKE '$senhaAtual'";

$resultado = mysqli_query($conexao, $consulta);

if(mysqli_num_rows($resultado) == 1){
    $novaSenha = $_POST["novaSenha"];
    $consulta = "UPDATE users SET password = '$novaSenha' WHERE id = '$id'";
    if(mysqli_query($conexao, $consulta)){
        unset($_SESSION['idUser']);
        unset($_SESSION['user']);
        session_unset();
        header("location: index.php");
    }
    else{
        echo "<h2>Não foi possível alterar a senha!</h2><br/><h4><a href='canvas.php'>Ir para tela Inicial</a></h4>";
    }
}
else{
    echo "<h2>Não foi possível alterar a senha!</h2><br/><h4><a href='canvas.php'>Ir para tela Inicial</a></h4>";
}
