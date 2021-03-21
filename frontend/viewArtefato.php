<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: ../index.php");
}
include_once("../backend/conexao.php");
$id = $_GET["id"];
$disciplinas = [
    "D1" => "Modelo de Negócios",
    "D2" => "Requisitos",
    "D3" => "Análise e Design",
    "D4" => "Implementação",
    "D5" => "Teste",
    "D6" => "Implantação",
    "D7" => "Gerência de Configuração e Mudança",
    "D8" => "Gerenciamento de Projeto",
    "D9" => "Ambiente"
];

$fases = ["Início","Elaboração","Contrução","Transição"];

$consulta = "SELECT a.id_disciplina_iteracao, a.nome, di.disciplina, i.nome as iteracao, i.id_fase as fase FROM artefatos a INNER JOIN disciplina_iteracao di ON(a.id_disciplina_iteracao = di.id) INNER JOIN iteracao i ON (di.id_iteracao = i.id) WHERE a.id = '$id'";
$resultado = mysqli_query($conexao, $consulta);
if($row = mysqli_fetch_assoc($resultado)){
    $idDisciplina = $row["id_disciplina_iteracao"];
    $nomeArtefato = $row["nome"];
    $disciplina = $disciplinas[$row["disciplina"]];
    $fase = $fases[$row["fase"] - 1];
    $iteracao = $row["iteracao"];
}



$consulta = "SELECT * FROM conteudo WHERE id_artefato = '$id'";

$resultado = mysqli_query($conexao, $consulta);

$conteudos = [];
$totalConteudo = 0;
while ($row = mysqli_fetch_assoc($resultado)) {
    $consulta = "SELECT * FROM subconteudo WHERE id_conteudo = '".$row['id']."'";
    $resultado2 = mysqli_query($conexao, $consulta);
    $subconteudos = [];
    while ($row2 = mysqli_fetch_assoc($resultado2)) {
        $consulta = "SELECT * FROM subconteudo2 WHERE id_subconteudo = '".$row2['id']."'";
        $resultado3 = mysqli_query($conexao, $consulta);
        $subconteudos2 = [];
        while ($row3 = mysqli_fetch_assoc($resultado3)) {
            $item3 = [
                "id" => $row3["id"],
                "titulo" => $row3["titulo"],
                "texto" => $row3["texto"]
            ];
            $subconteudos2[] = $item3;
        }
        $item2 = [
            "id" => $row2["id"],
            "titulo" => $row2["titulo"],
            "texto" => $row2["texto"],
            "subconteudos2" => $subconteudos2
        ];
        $subconteudos[] = $item2;
    }
    $totalConteudo += sizeof($subconteudos);
    $item = [
        "id" => $row["id"],
        "titulo" => $row["titulo"],
        "texto" => $row["texto"],
        "subconteudos" => $subconteudos
    ];
    $conteudos[] = $item;
}

$consulta = "SELECT * FROM anexos WHERE id_artefato = '$id'";

$resultado = mysqli_query($conexao, $consulta);
$anexos = [];

while ($row = mysqli_fetch_assoc($resultado)) {
    $anexos[] = [
        "id" => $row["id"],
        "nome" => $row["nome"],
        "tipo" => $row["tipo"],
        "conteudo" => base64_encode($row["conteudo"])
    ];
}

$artefatos = [];

$consulta = "SELECT a.id, f.id as fase, i.id as iteracao, a.nome, u.user as autor, a.data FROM artefatos a INNER JOIN disciplina_iteracao di ON (a.id_disciplina_iteracao = di.id) INNER JOIN iteracao i ON (di.id_iteracao = i.id) INNER JOIN fase f ON (i.id_fase = f.id) INNER JOIN users u ON (a.autor = u.id) WHERE a.nome LIKE '$nomeArtefato'";

$resultado = mysqli_query($conexao,$consulta);
while ($row = mysqli_fetch_assoc($resultado)) {
    $data = new DateTime($row["data"]);
    $data = $data->format("d/m/y");
    $artefatos[] = [
        "id" => $row["id"],
        "versao" => $row["fase"].".".$row["iteracao"],
        "nome" => $row["nome"],
        "autor" => $row["autor"],
        "data" => $data
    ];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ControlRUP</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-1">
                <a href="viewDisciplina.php?id=<?php echo $idDisciplina;?>"><img class="back" src="images/back.png" alt="Voltar"></a>
            </div>
            <div class="col-md-11 pt-4">
                <h2 class="text-center"><?php echo $nomeArtefato;?><h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 border-end pe-4 border-dark">
                <div class="row">
                    <div class="col text-center">
                        <?php echo "Fase: <br> <h4>$fase</h4> <br> Iteração: <br> <h4>$iteracao</h4> <br> Disciplina: <br> <h4>$disciplina</h4>";?>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <a class="btn btn-success border" href="editArtefato.php?id=<?php echo $id;?>">Editar Artefato</a>
                </div>
                <div class="row">
                    <a class="btn btn-success border" href="viewArtefato.php?id=<?php echo $id;?>" download="artefato.html">Baixar Artefato</a>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <table class="table table-striped">
                        <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Versão</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Autor</th>
                        </tr>
                        <?php foreach ($artefatos as $value) {?>
                            <tr>
                                <td><?php echo $value["data"];?></td>
                                <td><?php echo $value["versao"];?></td>
                                <td><a href="viewArtefato.php?id=<?php echo $value["id"];?>"><?php echo $value["nome"];?></a></td>
                                <td><?php echo $value["autor"];?></td>
                            </tr>
                        <?php }?> 
                    </table>
                </div>
                <div class="row">
                    <?php foreach ($conteudos as $key => $value) { ?>
                        <div class="col-md-12">
                            <label for="resumo" class="form-label"><h4><?php echo ($key+1)."-".$value["titulo"];?></h4></label>
                            <div class="form-control" name="conteudo[<?php echo $value["id"];?>]" rows="3"><?php echo $value["texto"];?></div>
                        </div>
                        <?php foreach ($value["subconteudos"] as $key2 => $subconteudo) {?>
                            <div class="col-md-1"></div>
                            <div class="col-md-11">
                                <label for="resumo" class="form-label"><h5><?php echo ($key+1)."-".($key2 + 1)."-".$subconteudo["titulo"];?></h5></label>
                                <div class="form-control" name="subconteudo[<?php echo $subconteudo["id"];?>]" rows="3"><?php echo $subconteudo["texto"];?></div>
                            </div>
                                <?php foreach ($subconteudo["subconteudos2"] as $key3 => $subconteudo2) {?>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <label for="resumo" class="form-label"><h6><?php echo ($key+1)."-".($key2 + 1)."-".($key3 + 1)."-".$subconteudo2["titulo"];?></h6></label>
                                        <div class="form-control" name="subconteudo2[<?php echo $subconteudo2["id"];?>]" rows="3"><?php echo $subconteudo2["texto"];?></div>
                                    </div>
                                <?php }?>
                        <?php }?>    
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <h3>Imagens</h3>
            <?php foreach ($anexos as $key => $value){?>
                <div class="col-md-6 border border-dark">
                    <img class="img-fluid" src="data:<?php echo $value["tipo"].";base64,".$value["conteudo"];?>"></img>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>