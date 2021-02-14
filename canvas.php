<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processo Unificado</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <br/>
        <h2 class="text-center">Laboratório de Processo Unificado</h2>
        <div class="row">
            <div class="col-md-2 text-center">
                <a href="novaIteracao.php?fase=1" class="btn btn-success border">Nova Iteração no &nbsp;&nbsp;Início</a>
                <a href="novaIteracao.php?fase=2" class="btn btn-success border">Nova Iteração na Elaboração</a>
                <a href="novaIteracao.php?fase=3" class="btn btn-success border">Nova Iteração na Contrução</a>
                <a href="novaIteracao.php?fase=4" class="btn btn-success border">Nova Iteração na Transição</a>
            </div>
            <div class="col-md-10">
                <canvas id="idCanvas" width="600" height="351" ></canvas>
            </div>
        </div>
    </div>
    <script src="grid.js"></script>
    <script src="canvas.js"></script>
</body>
</html>