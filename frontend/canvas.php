<?php
    session_start();
    if(!isset($_SESSION['idUser'])){
        unset($_SESSION['idUser']);
        unset($_SESSION['user']);
        session_unset();
        header("location: ../index.php");
    }
    $user = $_SESSION["user"];

    include_once("../backend/conexao.php");
    include_once("../backend/acessarProjeto.php");
    $nomeProjeto = acessarProjeto($_GET["projeto"],$conexao);
    $projeto = $_GET["projeto"]; 
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processo Unificado</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="confirmarSenha.js"></script>
    <?php  echo "<script>var idProjeto=$projeto;</script>";?>
</head>
<body>
    <div class="container-fluid">
        <br/>
        <div class="row">
                <div class="col-md-1">
                    <a href="projetos.php"><img class="back" src="images/back.png" alt="Voltar"></a>
                </div>
                <div class="col-md-10">
                    <div class="content">
                        <div id="titlecontent">
                            <?php echo $nomeProjeto;?>
                        </div>
                    </div>
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
            <div class="col-md-12">
                <canvas id="idCanvas" width="600" height="551" ></canvas>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <button type="button" class="btn btn-primary col-md-12" data-bs-toggle="modal" data-bs-target="#modalNovaIteracao">Nova Iteração</button>
                <div class="modal fade" id="modalNovaIteracao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nova Iteração</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <a href="../backend/novaIteracao.php?fase=1&projeto=<?php echo $projeto;?>" class="btn btn-success border col-md-12">Nova Iteração no Início</a>
                                <a href="../backend/novaIteracao.php?fase=2&projeto=<?php echo $projeto;?>" class="btn btn-success border col-md-12">Nova Iteração na Elaboração</a>
                                <a href="../backend/novaIteracao.php?fase=3&projeto=<?php echo $projeto;?>" class="btn btn-success border col-md-12">Nova Iteração na Contrução</a>
                                <a href="../backend/novaIteracao.php?fase=4&projeto=<?php echo $projeto;?>" class="btn btn-success border col-md-12">Nova Iteração na Transição</a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-danger col-md-12" data-bs-toggle="modal" data-bs-target="#modalRemovIteracao">Excluir Iteração</button>
                <div class="modal fade" id="modalRemovIteracao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Excluir Iteração</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <button class="btn btn-danger border col-md-12" onClick="deletarIteracao('Início',1,<?php echo $projeto;?>)">Remover a última Iteração do Início</button>
                                <button class="btn btn-danger border col-md-12" onClick="deletarIteracao('Elaboração',2,<?php echo $projeto;?>)">Remover a última Iteração da Elaboração</button>
                                <button class="btn btn-danger border col-md-12" onClick="deletarIteracao('Construção',3,<?php echo $projeto;?>)">Remover a última Iteração da Contrução</button>
                                <button class="btn btn-danger border col-md-12" onClick="deletarIteracao('Transição',4,<?php echo $projeto;?>)">Remover a última Iteração da Transição</button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
    <script src="grid.js"></script>
    <script src="canvas.js"></script>
</body>
</html>