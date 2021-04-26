<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: ../index.php");
}
$user = $_SESSION["user"];
$idUser = $_SESSION['idUser'];
$admin = $_SESSION["admin"];
require_once("../backend/conexao.php");

$consulta = "SELECT p.*, u.user as autor FROM projeto p INNER JOIN users_projeto us ON (p.id = us.projeto) INNER JOIN users u ON (p.autor = u.id) WHERE us.user = '$idUser'";
$resutado = mysqli_query($conexao, $consulta);
$projetos = [];
while ($row = mysqli_fetch_assoc($resutado)) {
    $data = new DateTime($row["created_at"]);
    $data = $data->format("d/m/y");
    $projetos[] = [
        "id" => $row["id"],
        "nome" => $row["nome"],
        "autor" => $row["autor"],
        "descricao" => $row["descricao"],
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
    <title>ControlRup</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="confirmarSenha.js"></script>
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-11">
                <h2 class="text-center">Projetos</h2>
            </div>
            <div class="col-md-1">
                <div class="btn-group dropend">
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
            <?php foreach ($projetos as $key => $value) { ?>
                <div class="col-md-4 pb-4">
                    <div class="card text-dark border-success mb-3 text-center" style="max-width: 18rem; height: 100%">
                        <div class="card-header"><h4><?php echo $value["nome"];?></h4></div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php echo $value["descricao"]?>
                                <h5>Autor: <?php echo $value["autor"];?></h5>
                                <h5>Criação: <?php echo $value["data"];?></h5>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="canvas.php?projeto=<?php echo $value["id"];?>" class="btn btn-success col-md-12 border">Acessar</a>
                            <?php if($admin){
                                $parametros = "'".$value["nome"]."','".$value["descricao"]."','".$value["id"]."'";
                                ?>
                                <button type="button" class="btn btn-success col-md-12 border" data-bs-toggle="modal" data-bs-target="#editProjeto" onclick="editProjeto(<?php echo $parametros;?>)">Editar</button>
                                <a href="adicionarUsuario.php?projeto=<?php echo $value["id"];?>" class="btn btn-success col-md-12 border">Adicionar Usuário</a>
                                <button type="button" class="btn btn-danger col-md-12 border" data-bs-toggle="modal" data-bs-target="#excluirProjeto" onclick="excluirProjeto(<?php echo $parametros;?>)">Excluir</button>
                            <?php }?>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        <?php if($admin){?>
            <form action="../backend/gerirProjeto.php" method="post">
                <div class="modal fade" id="editProjeto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tituloAdcionar">Projeto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <label for="anexos" class="form-label">Nome do Projeto: </label>
                                    <input type="text" name="nome" id="nome" class="form-control" required placeholder="Nome do Projeto">
                                    <input type="hidden" name="id" id="id">
                                </div>
                                <div class="row">
                                    <label for="anexos" class="form-label">Descrição do Projeto: </label>
                                    <textarea name="descricao" id="descricao" class="form-control" required placeholder="Breve Descrição do Projeto"></textarea>
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

            <form action="../backend/excluirProjeto.php" method="post">
                <div class="modal fade" id="excluirProjeto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tituloExcluir">Projeto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <label for="anexos" class="form-label">Informe sua senha para confirmar a exclusão: </label>
                                    <input type="password" name="senha" id="senha" class="form-control" required placeholder="Senha">
                                    <input type="hidden" name="id" id="idExcluir">
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
            
            <div class="row">
                <hr>
                <div class="col-md-12 text-center"><h5>Área do Administrador</h5></div>
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-success col-md-4" data-bs-toggle="modal" data-bs-target="#editProjeto">Novo Projeto</button>
                    <a href="novoUsuario.php" class="btn btn-primary col-md-4">Gerir Usuários</a>       
                </div>
            </div>
        <script>
            function editProjeto(nome,descricao,id) {
                var campoNome = document.querySelector("#nome");
                var campoId = document.querySelector("#id");
                var campoDescricao = document.querySelector("#descricao");
                campoNome.value = nome;
                campoDescricao.value = descricao;
                campoId.value = id;
            }
            function excluirProjeto(nome,descricao,id) {
                var campoNome = document.querySelector("#tituloExcluir");
                var campoId = document.querySelector("#idExcluir");
                campoNome.innerText = "Excluir Projeto: " + nome;
                campoId.value = id;
            }
        </script>  
        <?php }?>
    </div>  
</body>
</html>