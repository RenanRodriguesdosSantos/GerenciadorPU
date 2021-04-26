<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("../backend/conexao.php");
include_once("../backend/acessarProjeto.php");
$nomeProjeto = acessarProjeto($_GET["projeto"],$conexao);
$projeto = $_GET["projeto"]; 

$user = $_SESSION["user"];

$id = $_GET["id"];

$parametros = "f.nome as fase, i.nome as iteracao, di.disciplina, di.tempo";
$consulta = "SELECT $parametros FROM fase f inner join iteracao i on (f.id = i.id_fase) inner join disciplina_iteracao di on (di.id_iteracao = i.id) where di.id = '$id'";

$resultado = mysqli_query($conexao, $consulta);

$dados = [];
$fases = ["inicio" => "Início", "elaboracao" => "Elaboração", "construcao" => "Contrução", "transicao" => "Transição"];
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
        "fase" => $fases[$row["fase"]],
        "iteracao" => $row["iteracao"],
        "disciplina" => $disciplinas[$row["disciplina"]],
        "tempo" => $row["tempo"]
    ];
    $disciplinaCod = $row["disciplina"];
}

$consulta = "SELECT * FROM artefatos WHERE id_disciplina_iteracao = '$id'";

$resultado = mysqli_query($conexao, $consulta);
$artefatos = [];

while ($row = mysqli_fetch_assoc($resultado)) {
    $artefatos[] = [
        "nome" => $row["nome"],
        "id" => $row["id"],
        "renomeavel" => $row["renomeavel"]
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="confirmarSenha.js"></script>
    </head>
    <body >
        <div class="container tema">
            <div class="row">
                <div class="col-md-1">
                    <a href="canvas.php?projeto=<?php echo $projeto;?>"><img class="back" src="images/back.png" alt="Voltar"></a>
                </div>
                <div class="col-md-10">
                    <div class="content">
                        <div id="titlecontent">
                            <?php echo $nomeProjeto;?>
                        </div>
                        <div id="content" class="p-md-2 me-md-5">
                            <div class="text-center">
                                <h2><?php echo $dados["fase"]." - ".$dados["iteracao"]." - ".$dados["disciplina"];?></h2>
                            </div>
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
                                    <a href="../backend/sair.php" class="btn btn-danger">Confirmar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="../backend/alterarSenha.php" method="post" onsubmit="return confirmarSenhaForm()">
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
                                                <input type="password" class="form-control" id="senhaAtual" name="senhaAtual" placeholder="Senha Atual"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label htmlFor="novaSenha" class="col-sm-4 col-form-label"> Nova Senha: </label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="novaSenha" name="novaSenha" placeholder="Nova Senha"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label htmlFor="confirmarSenha" class="col-sm-4 col-form-label"> Confirmar Senha: </label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" placeholder="Confirmar Senha"/>
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
                <div class="col-md-12">
                    <h2>Artefatos</h2>
                        <ul>
                            <?php 
                                for ($i=0; $i < count($artefatos); $i++) { 
                                    $nome = $artefatos[$i]["nome"];
                                    $idArtefato = $artefatos[$i]["id"];
                            ?>
                                    <li>
                                        <h4>
                                            <a href='viewArtefato.php?id=<?php echo $idArtefato?>&projeto=<?php echo $projeto;?>'><?php echo $nome?></a>
                                            <?php if($artefatos[$i]["renomeavel"]){
                                                $parametros = "'$idArtefato','$nome','$id','$projeto'";
                                            ?>
                                                <button type="button" class="btn btn-primary pt-1 pb-1" data-bs-toggle="modal" data-bs-target="#renomear" onclick="renomear(<?php echo $parametros;?>)"><img src="images/edit.png" alt="Editar"></button>
                                                <button type="button" class="btn btn-danger pt-1 pb-1" onclick="deletarArtefato(<?php echo $parametros;?>)"><img src="images/delete.png" alt="Excluir"></button>
                                            <?php }?>
                                        </h4>
                                    </li>
                            <?php }?>
                        </ul>
                </div>
            </div>
            <form action="../backend/renameArtefato.php?disciplina=<?php echo $id;?>&projeto=<?php echo $projeto;?>" method="post">
                <div class="modal fade" id="renomear" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tituloAdcionar">Renomear Artefato</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <label for="anexos" class="form-label">Nome do Artefato: </label>
                                    <input type="text" name="nome" id="nome" class="form-control" required>
                                    <input type="hidden" name="id" id="id">
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
            
            <br><br><br><br><br>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#salvarTempo">Alterar Esforço na Disciplina</button>                         
            <form action="../backend/editarDisciplina.php?id=<?php echo $id;?>&projeto=<?php echo $projeto;?>" method="post">
                <div class="modal fade" id="salvarTempo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Salvar Esforço na Disciplina</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <label for="tempo" class="col-form-label col-md-4">Tempo gasto: </label>
                                    <div class="col-md-2">
                                        <input type="range" class="form-range" id="tempo" name="tempo" value="<?php echo $dados['tempo'];?>" min="0" max="25" oninput="display.value=value" onchange="display.value=value">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" id="display" value="<?php echo $dados['tempo'];?>" oninput="tempo.value=value" onchange="tempo.value=value" min="0" max="25">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php if($disciplinaCod == "D1"){?>
                <div class="row">
                    <div class="col-md-8 text-center">
                        <a href="../backend/novoArtefato.php?tipo=1&disciplina=<?php echo $id;?>&projeto=<?php echo $projeto;?>" class="btn btn-primary col-md-10 mb-2">Novo Artefato de Casos de Usos de Negócios</a>
                        <a href="../backend/novoArtefato.php?tipo=2&disciplina=<?php echo $id;?>&projeto=<?php echo $projeto;?>" class="btn btn-primary col-md-10">Novo Artefato de Realização de Casos de Usos de Negócios</a>
                    </div>
                </div>
            <?php }
              else if($disciplinaCod == "D2"){?>
                <div class="row">
                    <div class="col-md-8 text-center">
                        <a href="../backend/novoArtefato.php?tipo=3&disciplina=<?php echo $id;?>&projeto=<?php echo $projeto;?>" class="btn btn-primary col-md-10 mb-2">Novo Artefato de Casos de Usos</a>
                        <a href="../backend/novoArtefato.php?tipo=4&disciplina=<?php echo $id;?>&projeto=<?php echo $projeto;?>" class="btn btn-primary col-md-10"> Novo Artefato de Requisitos de Software Para < Subsistema ou Recurso></a>
                    </div>
                </div>
            <?php }
            else if($disciplinaCod == "D3"){?>
                <div class="row">
                    <div class="col-md-8 text-center">
                        <a href="../backend/novoArtefato.php?tipo=5&disciplina=<?php echo $id;?>&projeto=<?php echo $projeto;?>" class="btn btn-primary col-md-10 mb-2">Novo Artefato de Realização de Casos de Usos</a>
                    </div>
                </div>
            <?php }?>
        </div>
        <script>
            function renomear(id, valor) {
                var campo = document.querySelector("#nome");
                campo.value = valor;
                var idCampo =  document.querySelector("#id");
                idCampo.value = id;
            }

            function deletarArtefato(id,nome,disciplina,projeto) {
                return swal({
                    title: "Excluir Artefato",
                    icon: "error",
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    text: "Deseja realmente excluir o artefato " + nome + "?",
                    buttons: {
                        cancel: {
                            text: "    Não   ",
                            value: false,
                            visible: true,
                            className: "btn btn-warning"
                        },
                        sim: {
                            text: "  Sim Excluir   ",
                            value: true,
                            visible: true,
                            className: "btn btn-danger"
                        }
                    }
                })
                .then(response =>{
                    if(response){
                        window.location.href = "../backend/deletarArtefato.php?id=" + id+"&disciplina=" + disciplina + "&projeto=" + projeto;
                    }
                })
            }
        </script>
    </body>
</html>