<?php

include_once("conexao.php");

$id = $_GET["id"];

$parametros = "f.nome as fase, i.nome as iteracao, di.disciplina, di.tempo";
$consulta = "SELECT $parametros FROM fase f inner join iteracao i on (f.id = i.id_fase) inner join disciplina_iteracao di on (di.id_iteracao = i.id) where di.id = '$id'";

$resultado = mysqli_query($conexao, $consulta);

$dados = [];
if($row = mysqli_fetch_assoc($resultado)){
    $dados = [
        "fase" => $row["fase"],
        "iteracao" => $row["iteracao"],
        "disciplina" => $row["disciplina"],
        "tempo" => $row["tempo"]
    ];
}

echo json_encode($dados);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="canvas.php">Painel de Controle</a>
    <form action="">
    
    <input type="range" id="tempo" name="tempo" value="0" min="0" max="25" oninput="display.value=value" onchange="display.value=value" required>
    <input type="number" id="display" value="0" min="0" max="25" oninput="tempo.value=value" onchange="tempo.value=value">
    </form>
</body>
</html>