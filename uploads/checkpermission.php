<?php 

session_start();
$id = $_GET["id"];

$arquivo = $_SERVER['REQUEST_URI'];
$arquivo = explode("/",$arquivo)[3];
if(isset($_SESSION['user'])) { 
    if(file_exists($arquivo)){
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="'.$arquivo.'"');
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($arquivo));
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Expires: 0');
        readfile($arquivo);
        header("Location: _/viewDisciplina.php?id=$id");
    } 
    else {
        echo '<h1> Erro, o arquivo solicitado não existe!</h1>';
    }
} 
else {
    echo '<h1>Arquivo disponível apenas para usuários autenticados!</h1>';
}