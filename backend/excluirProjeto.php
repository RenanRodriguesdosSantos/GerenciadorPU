<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}

if($_SESSION["admin"]){
    include_once("conexao.php");
    $id = $_SESSION["idUser"];
    $senhaAtual = $_POST["senha"];
    
    $consulta = "SELECT * FROM users WHERE id = '$id' and password LIKE md5('$senhaAtual')";
    
    $resultado = mysqli_query($conexao, $consulta);
    
    if(mysqli_num_rows($resultado) == 1){
        $idProjeto = $_POST['id'];
        $consulta = "DELETE FROM projeto WHERE id = '$idProjeto'";
        mysqli_query($conexao, $consulta);
        header("Location: ../frontend/projetos.php");
    }
    else{
        echo "<h2>Senha Incorreta!</h2><br/><h4><a href='../frontend/projetos.php'>Ir para tela Inicial</a></h4>";
    }
}
