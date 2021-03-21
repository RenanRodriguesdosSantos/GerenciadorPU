<?php
include_once("conexao.php");

$artefato = $_GET["artefato"];


$consulta = "SELECT c.id, c.titulo, a.nome, di.id as disciplina FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) INNER JOIN disciplina_iteracao di ON (di.id = a.id_disciplina_iteracao) where a.id = '$artefato'";
$resultado = mysqli_query($conexao,$consulta);
$conteudos = [];
$nomeArtefato= "-";
while ($row  = mysqli_fetch_assoc($resultado)) {
    $conteudos[] = [
        "id" => $row["id"],
        "titulo" => $row["titulo"]
    ];
    $nomeArtefato = $row["nome"];
    $idDisciplina = $row["disciplina"];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="listaArtefato.php?disciplina=<?php echo $idDisciplina;?>" class="btn btn-primary">Voltar</a>
            </div>
            <div class="col-md-10">
                <h2 class="text-center">
                    <?php echo $nomeArtefato;?>
                </h2>
            </div>
        </div>
        <form action="novoConteudo.php?artefato=<?php echo $artefato;?>" method="post">
            <div class="row">
                <label for="conteudo" class="form-label col-md-1">Conteudo:</label>
                <div class="col-md-9">
                    <input type="text" name="conteudo" id="conteudo" class="form-control" placeholder="Conteudo" required>
                </div>
                <button type="submit" class="btn btn-success col-md-2">Salvar</button>
            </div>
        </form>
        <br><br><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Título</th>
                        <th scope="col">Acessar SubConteudos</th>
                    </tr>
                    <?php foreach ($conteudos as $value) {?>
                        <tr>
                            <th scope="row"><?php echo $value["id"];?></th>
                            <td><?php echo $value["titulo"];?></td>
                            <td><a href="listaSubConteudo.php?conteudo=<?php echo $value["id"];?>" class="btn btn-primary">SubConteudos</a></td>
                        </tr>
                    <?php }?> 
                </table>
            </div>
        </div>
    </div>
</body>
</html>