<?php
include_once("conexao.php");

$conteudo = $_GET["conteudo"];


$consulta = "SELECT s.id, c.titulo as conteudo, s.titulo, a.id as artefato FROM subconteudo s INNER JOIN conteudo c ON (c.id = s.id_conteudo) INNER JOIN artefatos a ON (c.id_artefato = a.id) where c.id = '$conteudo'";
$resultado = mysqli_query($conexao,$consulta);
$subconteudos = [];
$nomeConteudo = '-';
while ($row  = mysqli_fetch_assoc($resultado)) {
    $subconteudos[] = [
        "id" => $row["id"],
        "titulo" => $row["titulo"]
    ];
    $nomeConteudo = $row["conteudo"];
    $idArtefato = $row["artefato"];
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
                <a href="listaConteudo.php?artefato=<?php echo $idArtefato;?>" class="btn btn-primary">Voltar</a>
            </div>
            <div class="col-md-10">
                <h2 class="text-center">
                    <?php echo $nomeConteudo;?>
                </h2>
            </div>
        </div>
        <form action="novoSubConteudo.php?conteudo=<?php echo $conteudo;?>" method="post">
            <div class="row">
                <label for="subconteudo" class="form-label col-md-1">SubConteudo:</label>
                <div class="col-md-9">
                    <input type="text" name="subconteudo" id="subconteudo" class="form-control" placeholder="SubConteudo" required>
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
                    </tr>
                    <?php foreach ($subconteudos as $value) {?>
                        <tr>
                            <th scope="row"><?php echo $value["id"];?></th>
                            <td><?php echo $value["titulo"];?></td>
                        </tr>
                    <?php }?> 
                </table>
            </div>
        </div>
    </div>
</body>
</html>