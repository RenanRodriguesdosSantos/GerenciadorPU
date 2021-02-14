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

//echo json_encode($dados);

?>

<<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RUP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat');
        </style>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body>
        <div class="content">
            <a href="canvas.php"><img class="back" src="images/back.png" alt="Voltar"></a>
            <div id="titlecontent">
                Conteúdo
            </div>
            <div id="content">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque cursus euismod ex blandit viverra. Aenean ut elit arcu. Vestibulum mollis imperdiet lacus, finibus luctus mi hendrerit nec. Sed eget magna iaculis, ullamcorper sem quis, eleifend diam. Fusce pulvinar, orci eget convallis convallis, ligula justo mattis quam, dictum pretium mauris nibh ac libero. Nulla porttitor sed odio vitae sagittis. Duis quis laoreet mi. Curabitur in viverra augue, ut congue risus. Fusce lectus arcu, semper eu purus sed, interdum suscipit lacus. Nunc interdum viverra lacus et egestas. Nunc lacus arcu, sollicitudin ut lobortis et, faucibus hendrerit nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus a justo in lacus semper elementum quis eu tellus. Maecenas ac quam lobortis, malesuada ligula ac, aliquet quam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Morbi nec dapibus ligula, nec dapibus erat.
            </div>
        </div>
        <div class="flutuarmain">
                <h1>
                conteudo
                </h1>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque cursus euismod ex blandit viverra. Aenean ut elit arcu. Vestibulum mollis 
                </p>
                <h3>
                    subtitulo
                </h3>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque cursus euismod ex blandit viverra. Aenean ut elit arcu. Vestibulum mollis 
                </p>
                <h3>
                    subtitulo
                </h3>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque cursus euismod ex blandit viverra. Aenean ut elit arcu. Vestibulum mollis 
                </p>
                <h3>
                    subtitulo
                </h3>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque cursus euismod ex blandit viverra. Aenean ut elit arcu. Vestibulum mollis 
                </p>
            </div>
            <div class="flutuarlinks">
                <h3>
                links
                </h2>
                <ul>Link 1</ul>
                <ul>Link 1</ul>
                <ul>Link 1</ul>
                <ul>Link 1</ul>
                <ul>Link 1</ul>
                <ul>Link 1</ul>
            </div>
    </body>
</html>