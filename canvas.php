<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processo Unificado</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <br/>
        <h2 class="text-center">Laboratório de Processo Unificado</h2>
        <div class="row">
            <div class="col-md-12">
                <canvas id="idCanvas" width="600" height="401" ></canvas>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="novaIteracao.php?fase=1" class="btn btn-success border col">Nova Iteração no Início</a>
                <a href="novaIteracao.php?fase=2" class="btn btn-success border col">Nova Iteração na Elaboração</a>
                <a href="novaIteracao.php?fase=3" class="btn btn-success border col">Nova Iteração na Contrução</a>
                <a href="novaIteracao.php?fase=4" class="btn btn-success border col">Nova Iteração na Transição</a>
            </div>
            <div class="col-md-4">
                <button class="btn btn-danger border col" onClick="deletarIteracao('Início',1)">Remover a última Iteração do Início</button>
                <button class="btn btn-danger border col" onClick="deletarIteracao('Elaboração',2)">Remover a última Iteração da Elaboração</button>
                <button class="btn btn-danger border col" onClick="deletarIteracao('Construção',3)">Remover a última Iteração da Contrução</button>
                <button class="btn btn-danger border col" onClick="deletarIteracao('Transição',4)">Remover a última Iteração da Transição</button>
            </div>
        </div>
    </div>
    <script src="grid.js"></script>
    <script src="canvas.js"></script>
</body>
</html>