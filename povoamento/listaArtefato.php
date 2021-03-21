<?php
include_once("conexao.php");

$disciplina = $_GET["disciplina"];

$disciplinas = ["Modelo de Negócios","Requisitos","Análise e Design","Implementação","Teste","Implantação","Gerência de Configuração e Mudança","Gerenciamento de Projeto","Ambiente"];

$consulta = "SELECT * FROM artefatos where id_disciplina_iteracao = '$disciplina'";
$resultado = mysqli_query($conexao,$consulta);
$artefatos = [];
while ($row  = mysqli_fetch_assoc($resultado)) {
    $artefatos[] = [
        "id" => $row["id"],
        "nome" => $row["nome"]
    ];
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
            <h2 class="text-center">
                <?php echo $disciplinas[$disciplina-1];?>
            </h2>
        </div>
        <form action="novoArtefato.php?disciplina=<?php echo $disciplina;?>" method="post">
            <div class="row">
                <label for="artefato" class="form-label col-md-1">Artefato:</label>
                <div class="col-md-9">
                    <input type="text" name="artefato" id="artefato" class="form-control" placeholder="Artefato" required>
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
                        <th scope="col">Nome</th>
                        <th scope="col">Acessar Conteudos</th>
                    </tr>
                    <?php foreach ($artefatos as $value) {?>
                        <tr>
                            <th scope="row"><?php echo $value["id"];?></th>
                            <td><?php echo $value["nome"];?></td>
                            <td><a href="listaConteudo.php?artefato=<?php echo $value["id"];?>" class="btn btn-primary">Conteudos</a></td>
                        </tr>
                    <?php }?> 
                </table>
            </div>
        </div>
    </div>
</body>
</html>