<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}
include_once("conexao.php");

$user = $_SESSION["user"];

$id = $_GET["id"];

$parametros = "f.id as fase, i.nome as iteracao, di.disciplina, di.tempo, di.resumo, di.texto";
$consulta = "SELECT $parametros FROM fase f inner join iteracao i on (f.id = i.id_fase) inner join disciplina_iteracao di on (di.id_iteracao = i.id) where di.id = '$id'";

$resultado = mysqli_query($conexao, $consulta);

$dados = [];
$fases = ["Início","Elaboração","Contrução","Transição"];
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
$disciplinaCod = 0;
if($row = mysqli_fetch_assoc($resultado)){
    $dados = [
        "fase" => $fases[$row["fase"]-1],
        "iteracao" => $row["iteracao"],
        "disciplina" => $disciplinas[$row["disciplina"]],
        "tempo" => $row["tempo"],
        "resumo" => $row["resumo"],
        "texto" => $row["texto"]
    ];
    $disciplinaCod = $row["disciplina"];
}

$consulta = "SELECT * FROM artefatos WHERE id_disciplina_iteracao = '$id'";

$resultado = mysqli_query($conexao, $consulta);
$artefatos = [];
$i = 0;
while ($row = mysqli_fetch_assoc($resultado)) {
    $artefatos[$i] = [
        "nome" => $row["nome"],
        "id" => $row["id"]
    ];
    $i++;
}
$anterior = $id;
$proxima = $id;
if($disciplinaCod != 0){
    $consulta = "SELECT * FROM disciplina_iteracao WHERE disciplina = '$disciplinaCod' and id < '$id' LIMIT 1";
    $resultado = mysqli_query($conexao, $consulta);
    if($row = mysqli_fetch_assoc($resultado)){
        $anterior = $row["id"];
    }

    $consulta = "SELECT * FROM disciplina_iteracao WHERE disciplina = '$disciplinaCod' and id > '$id' LIMIT 1";
    $resultado = mysqli_query($conexao, $consulta);
    if($row = mysqli_fetch_assoc($resultado)){
        $proxima = $row["id"];
    }
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
        <script>
            function confirmarSenhaForm() {
                var senha = document.querySelector("#novaSenha").value;
                if(!senha){
                    var alertSenha = document.querySelector("#alertSenha");
                    alertSenha.innerText = "Preencha todos os campos!";
                    alertSenha.classList.remove("d-none");
                    return false;
                }
                else{
                    var senhaConfirmar = document.querySelector("#confirmarSenha").value;
                    if(senha == senhaConfirmar){
                        return true;
                    }
                    else{
                        var alertSenha = document.querySelector("#alertSenha");
                        alertSenha.innerText = "Senhas Diferentes!";
                        alertSenha.classList.remove("d-none");
                        return false;
                    }
                }
            }
        </script>
    </head>
    <body >
        <div class="container-fluid tema">
            <div class="row">
                <div class="col-md-1">
                    <a href="canvas.php"><img class="back" src="images/back.png" alt="Voltar"></a>
                </div>
                <div class="col-md-10">
                    <div class="content">
                        <div id="titlecontent">
                            <?php echo $dados["fase"]." - ".$dados["iteracao"]." - ".$dados["disciplina"];?>
                        </div>
                        <div id="content" class="p-md-2 me-md-5">
                            <?php echo $dados["resumo"];?>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="btn-group mt-md-3 dropend">
                        <button class="btn btn-success btn-lg text-uppercase rounded-circle pb-md-2 pt-md-2 ps-md-3 pe-md-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo str_split($user)[0];?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><p class="dropdown-item text-center text-uppercase"><?php echo $user;?></p></li>
                            <li><button class="btn bg-info text-center col-md-12 border dropdown-item" data-bs-toggle="modal" data-bs-target="#modalAlterarSenha">Alterar Senha</button></li>
                            <li><button class="btn bg-info text-center col-md-12 border dropdown-item" data-bs-toggle="modal" data-bs-target="#modalConfirmarSair">Sair</button></li>
                        </ul>
                    </div>
                    <div class="modal fade" id="modalConfirmarSair" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Sair</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Deseja Realmente Sair?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <a href="sair.php" class="btn btn-danger">Confirmar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="alterarSenha.php" method="post" onsubmit="return confirmarSenhaForm()">
                        <div class="modal fade" id="modalAlterarSenha" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Alterar Senha</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label htmlFor="senhaAtual" class="col-sm-4 col-form-label"> Senha Atual: </label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="senhaAtual" placeholder="Senha Atual"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label htmlFor="novaSenha" class="col-sm-4 col-form-label"> Nova Senha: </label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="novaSenha" placeholder="Nova Senha"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label htmlFor="confirmarSenha" class="col-sm-4 col-form-label"> Confirmar Senha: </label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="confirmarSenha" placeholder="Confirmar Senha"/>
                                            </div>
                                        </div>
                                        <div class="alert alert-danger d-none" role="alert" id="alertSenha">
                                            Senhas Diferentes!
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>    
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
                            <form action="editarDisciplina.php?id=<?php echo $id;?>" method="post" onSubmit="salvar()" enctype="multipart/form-data">
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
                                                        <div>
                                                            <label for="resumo" class="form-label">Resumso das Atividades:</label>
                                                            <textarea class="form-control" id="resumo" name="resumo" rows="3" placeholder="Resumo das Atividades desenvolvidas nessa iteração e disciplina"><?php echo $dados["resumo"];?></textarea>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="row">
                                                        <label class="form-label">Artefatos</label>
                                                        <input type="file" multiple name="artefatos[]" id="artefatos"/>
                                                        <div id="artefatosCustum" onClick="defaultInputActive()" 
                                                            ondragenter="event.stopPropagation();event.preventDefault();"
                                                            ondragover="event.stopPropagation();event.preventDefault();"
                                                            ondrop="doDrop(event);"
                                                        >
                                                            <div id="artefatosCustumInterna" class="row">
                                                                <span id="placeholderArtefatos">Clique para selecionar ou arraste os arquivos!</span>
                                                            </div>
                                                        </div>
                                                    </div>
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
                    <div>
                        <a href="viewDisciplina.php?id=<?php echo $anterior?>">Iteraçao Anterior</a>
                        <a href="viewDisciplina.php?id=<?php echo $proxima?>">Proxima Iteraçao</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="flutuarlinks">
                        <h3>Artefatos</h3>
                        <ul>
                            <?php 
                                for ($i=0; $i < count($artefatos); $i++) { 
                                    $nome = $artefatos[$i]["nome"];
                                    echo "<li><a href='uploads/$nome?id=$id'>$nome</a></li>";
                                }
                            ?>
                        </ul>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluirAnexos">Excluir Artefatos</button>
                        <form action="excluirAnexos.php?id=<?php echo $id;?>" method="post">
                            <div class="modal fade" id="excluirAnexos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Excluir Artefatos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="row">
                                                    <label for="anexos">Selecione: </label>
                                                    <select class="p-2" name="anexos[]" id="anexos" multiple size="10">
                                                        <?php 
                                                            for ($i=0; $i < count($artefatos); $i++) { 
                                                                $nome = $artefatos[$i]["nome"];
                                                                $idAnexo = $artefatos[$i]["id"];
                                                                echo "<option value='$idAnexo'>$nome</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="editText.js"></script>
        <script src="editArtefatos.js"></script>
    </body>
</html>