<?php

session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}
include_once("conexao.php");

$tempo  = $_POST["tempo"];
$id = $_GET["id"];
$resumo = $_POST["resumo"];
$texto = $_POST["texto"];

$arquivos = $_FILES["artefatos"];

$artefatos = $arquivos["name"];

$consulta = "INSERT INTO artefatos (nome, id_disciplina_iteracao) VALUES ";
for ($i=0; $i < count($artefatos); $i++) { 
    $artefatos[$i] = "v_" .$id ."_". $artefatos[$i];
    if(file_exists("uploads/" . $artefatos[$i])){
        move_uploaded_file($_FILES['artefatos']['tmp_name'][$i], "uploads/" . $artefatos[$i]);
    }
    else{
        if(move_uploaded_file($_FILES['artefatos']['tmp_name'][$i], "uploads/" . $artefatos[$i])){
            $consulta .= "('$artefatos[$i]','$id')";
            if($i != (count($artefatos) - 1) &&  count($artefatos) > 1){
                $consulta .= ",";
            }
        }
    }
    
}

echo $consulta;

if($consulta != "INSERT INTO artefatos (nome, id_disciplina_iteracao) VALUES "){
    mysqli_query($conexao, $consulta);
}


$consulta = "UPDATE disciplina_iteracao SET tempo = '$tempo', resumo = '$resumo', texto = '$texto' WHERE id = '$id'";
mysqli_query($conexao, $consulta);

header("Location: viewDisciplina.php?id=$id");

