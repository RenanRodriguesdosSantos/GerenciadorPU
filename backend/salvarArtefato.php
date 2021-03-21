<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}
$id = $_GET["id"];
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include_once("conexao.php");
$conteudos = $_POST["conteudo"];
$subconteudos = $_POST["subconteudo"];

foreach ($conteudos as $key => $value) {
    $consulta = "UPDATE conteudo SET texto = '$value' WHERE id = '$key'";
    mysqli_query($conexao, $consulta);
}

foreach ($subconteudos as $key => $value) {
    $consulta = "UPDATE subconteudo SET texto = '$value' WHERE id = '$key'";
    mysqli_query($conexao, $consulta);
}

if(isset($_POST["subconteudo2"])){
    $subconteudos2 = $_POST["subconteudo2"];
    foreach ($subconteudos2 as $key => $value) {
        $consulta = "UPDATE subconteudo2 SET texto = '$value' WHERE id = '$key'";
        mysqli_query($conexao, $consulta);
    }
}

$arquivos = $_FILES["imagens"];
$images = $arquivos["name"];

if(!empty($_FILES["imagens"]["name"][0])){
    foreach ($images as $key => $value) {
        $tipo = $_FILES["imagens"]["type"][$key];
        $tamanho = $_FILES["imagens"]["size"][$key];
       if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/',$tipo)){
           echo "Tipo de Imagem Incompatível";
           exit();
       }
       else if($tamanho > (2 * 1024 * 1024)){
           echo "O arquivo deve possuir no máximo 2MB";
           exit();
       }
       else{
            if($_FILES["imagens"]["tmp_name"][$key] != "none"){
                $fp = fopen($_FILES["imagens"]["tmp_name"][$key], "rb");
                $conteudo = fread($fp, $tamanho);
                $conteudo = addslashes($conteudo);
                fclose($fp);
        
                $nome = $value;
                $consulta = "INSERT INTO anexos(nome, tipo, conteudo, tamanho, id_artefato) VALUES ('$nome','$tipo','$conteudo','$tamanho','$id')";
                mysqli_query($conexao, $consulta);
            }
       }
    }
}

header("Location: ../frontend/viewArtefato.php?id=".$id);

