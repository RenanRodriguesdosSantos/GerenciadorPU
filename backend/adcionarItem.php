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
$topico = $_POST["topico"];
$artefato = $_GET["artefato"];

if($_POST["tipo"] == "subconteudo"){
    $conteudo = $_POST["topicoPrincipal"];
    $resutado = mysqli_query($conexao,"SELECT id FROM subconteudo WHERE id_conteudo = '$conteudo' AND titulo LIKE '$topico'");
    if(mysqli_num_rows($resutado) > 0){
        echo "<h1>Não é possível salvar dois tópicos com mesmo nome na mesma sessão!</h1> ";
        echo "<h2><a href='../frontend/editArtefato.php?id=$artefato'>Voltar</a></h2> ";
    }
    else{
        if($id == ""){
            $consulta = "INSERT INTO subconteudo (titulo,editavel,renomeavel,id_conteudo) VALUE ('$topico','1','1','$conteudo')";
            mysqli_query($conexao,$consulta);
        }
        else{
            $consulta = "UPDATE subconteudo SET titulo = '$topico' WHERE id = '$id'";
            mysqli_query($conexao,$consulta);
        }
        header("Location: ../frontend/editArtefato.php?id=$artefato");
    }
}
else if($_POST["tipo"] == "subconteudo2"){
    $subconteudo = $_POST["topicoPrincipal"];
    $resutado = mysqli_query($conexao,"SELECT id FROM subconteudo2 WHERE id_subconteudo = '$subconteudo' AND titulo LIKE '$topico'");
    if(mysqli_num_rows($resutado) > 0){
        echo "<h1>Não é possível salvar dois tópicos com mesmo nome na mesma sessão!</h1> ";
        echo "<h2><a href='../frontend/editArtefato.php?id=$artefato'>Voltar</a></h2> ";
    }
    else{
        if($id == ""){
            $consulta = "INSERT INTO subconteudo2 (titulo,renomeavel,id_subconteudo) VALUE ('$topico','1','$subconteudo')";
            mysqli_query($conexao,$consulta);
            echo $consulta;
        }
        else{
            $consulta = "UPDATE subconteudo2 SET titulo = '$topico' WHERE id = '$id'";
            mysqli_query($conexao,$consulta);
        }
        header("Location: ../frontend/editArtefato.php?id=$artefato");
    }
}



