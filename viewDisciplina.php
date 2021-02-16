<?php

include_once("conexao.php");

$id = $_GET["id"];

$parametros = "f.id as fase, i.nome as iteracao, di.disciplina, di.tempo, di.resumo, di.texto";
$consulta = "SELECT $parametros FROM fase f inner join iteracao i on (f.id = i.id_fase) inner join disciplina_iteracao di on (di.id_iteracao = i.id) where di.id = '$id'";

$resultado = mysqli_query($conexao, $consulta);

$dados = [];
$fases = ["Início","Elaboração","Contrução","Transição"];
$disciplinas = [
    "D1" => "Requisitos",
    "D2" => "Análise",
    "D3" => "Projeto",
    "D4" => "Implementação",
    "D5" => "Teste"
];
if($row = mysqli_fetch_assoc($resultado)){
    $dados = [
        "fase" => $fases[$row["fase"]-1],
        "iteracao" => $row["iteracao"],
        "disciplina" => $disciplinas[$row["disciplina"]],
        "tempo" => $row["tempo"],
        "resumo" => $row["resumo"],
        "texto" => $row["texto"]
    ];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
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
    <body >
        <div class="container-fluid tema">
            <div class="row">
                <div class="col-md-1">
                    <a href="canvas.php"><img class="back" src="images/back.png" alt="Voltar"></a>
                </div>
                <div class="col-md-11">
                    <div class="content">
                        <div id="titlecontent">
                            <?php echo $dados["fase"]." - ".$dados["iteracao"]." - ".$dados["disciplina"];?>
                        </div>
                        <div id="content" class="p-md-2 me-md-5">
                            <?php echo $dados["resumo"];?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="flutuarmain">
                        <div>
                            <?php echo $dados["texto"];?>
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <button type="button" class="btn btn-primary col-md-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Editar Página</button>
                            <form action="editarDisciplina.php?id=<?php echo $id;?>" method="post" onSubmit="salvar()">
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Editar Página</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row text-start">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label for="tempo" class="col-form-label col-md-4">Tempo gasto: </label>
                                                        <div class="col-md-2">
                                                            <input type="range" class="form-range" id="tempo" name="tempo" value="<?php echo $dados['tempo'];?>" min="0" max="25" oninput="display.value=value" onchange="display.value=value">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="number" id="display" value="<?php echo $dados['tempo'];?>" oninput="tempo.value=value" onchange="tempo.value=value" min="0" max="25">
                                                        </div>
                                                        <hr/>
                                                    </div>
                                                    <div class="row">
                                                        <div class=">
                                                            <label for="resumo" class="form-label">Resumso das Atividades:</label>
                                                            <textarea class="form-control" id="resumo" name="resumo" rows="3" placeholder="Resumo das Atividades desenvolvidas nessa iteração e disciplina"><?php echo $dados["resumo"];?></textarea>
                                                        </div>
                                                    </div>
                                                    <br/><br/><br/><br/><br/><br/><br/><br/><br/>
                                                </div>
                                                <div class="col-md-6" >
                                                    <div class="card">
                                                        <div class="card-header p-md-1">
                                                            <ul class="tool-list m-md-0">
                                                                <li class="tool">
                                                                    <button type="button" class="tool-btn" data-command="justifyLeft">
                                                                        <img src="icons/left.ico" width="20px" height="20px"/>
                                                                    </button>
                                                                </li>
                                                                <li class="tool">
                                                                    <button type="button" class="tool-btn" data-command="justifyCenter">
                                                                        <img src="icons/center.ico" width="20px" height="20px"/>
                                                                    </button>
                                                                </li>
                                                                <li class="tool">
                                                                    <button type="button" class="tool-btn" data-command="bold">
                                                                        <img src="icons/bold.ico" width="20px" height="20px"/>
                                                                    </button>
                                                                </li>
                                                                <li class="tool">
                                                                    <button type="button" class="tool-btn" data-command="italic">
                                                                        <img src="icons/italico.ico" width="20px" height="20px"/>
                                                                    </button>
                                                                </li>
                                                                <li class="tool">
                                                                    <button type="button" class="tool-btn" data-command="underline">
                                                                        <img src="icons/underline.ico" width="20px" height="20px"/>
                                                                    </button>
                                                                </li>
                                                                <li class="tool">
                                                                    <button type="button" class="tool-btn" data-command="insertOrderedList">
                                                                        <img src="icons/listN.ico" width="20px" height="20px"/>
                                                                    </button>
                                                                </li>
                                                                <li class="tool">
                                                                    <button type="button" class="tool-btn" data-command="insertUnorderedList">
                                                                        <img src="icons/list.ico" width="20px" height="20px" />
                                                                    </button>
                                                                </li>
                                                                <li class="tool">
                                                                    <button type="button" class="tool-btn" data-command="createLink">
                                                                        <img src="icons/link.ico" width="20px" height="20px"/>
                                                                    </button>
                                                                </li>
                                                                <li class="tool">
                                                                    <select class="tool-select" onChange="formatDoc('formatblock',this[this.selectedIndex].value);this.selectedIndex=0;">
                                                                        <option selected>-Título-</option>
                                                                        <option value="h1">Título 1</option>
                                                                        <option value="h2">Título 2</option>
                                                                        <option value="h3">Título 3</option>
                                                                        <option value="h4">Título 4</option>
                                                                        <option value="h5">Título 5</option>
                                                                        <option value="h6">Título 6</option>
                                                                    </select>
                                                                </li>
                                                                <li class="tool">
                                                                    <select class="tool-select" onChange="formatDoc('forecolor',this[this.selectedIndex].value);this.selectedIndex=0;">
                                                                        <option selected>- Cor -</option>
                                                                        <option value="red">Red</option>
                                                                        <option value="blue">Blue</option>
                                                                        <option value="green">Green</option>
                                                                        <option value="black">Black</option>
                                                                    </select>
                                                                </li>
                                                                <li class="tool">
                                                                    <select class="tool-select" onChange="formatDoc('fontname',this[this.selectedIndex].value);this.selectedIndex=0;">
                                                                        <option selected>- Fonte -</option>
                                                                        <option>Arial</option>
                                                                        <option>Arial Black</option>
                                                                        <option>Courier New</option>
                                                                        <option>Times </option>
                                                                    </select>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <input type="hidden" name="texto" id="texto">
                                                        <div class="card-body" contenteditable="true" id="output"><?php echo $dados["texto"];?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success">Salvar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="flutuarlinks">
                        <h3>Anexos</h3>
                        <ul>Link 1</ul>
                        <ul>Link 1</ul>
                        <ul>Link 1</ul>
                        <ul>Link 1</ul>
                        <ul>Link 1</ul>
                        <ul>Link 1</ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="editText.js"></script>
    </body>
</html>