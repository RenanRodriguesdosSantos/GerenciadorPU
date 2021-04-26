<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: ../index.php");
}

include_once("../backend/conexao.php");
include_once("../backend/acessarProjeto.php");
acessarProjeto($_GET["projeto"],$conexao);
$projeto = $_GET["projeto"];
$id = $_GET["id"];

$consulta = "SELECT * FROM conteudo WHERE id_artefato = '$id'";

$resultado = mysqli_query($conexao, $consulta);

$conteudos = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $consulta = "SELECT * FROM subconteudo WHERE id_conteudo = '".$row['id']."'";
    $resultado2 = mysqli_query($conexao, $consulta);
    $subconteudos = [];
    while ($row2 = mysqli_fetch_assoc($resultado2)) {
        $consulta = "SELECT * FROM subconteudo2 WHERE id_subconteudo = '".$row2['id']."'";
        $resultado3 = mysqli_query($conexao, $consulta);
        $subconteudos2 = [];
        while ($row3 = mysqli_fetch_assoc($resultado3)){
            $item3 = [
                "id" => $row3["id"],
                "titulo" => $row3["titulo"],
                "texto" => $row3["texto"],
                "renomeavel" => $row3["renomeavel"]
            ];
            $subconteudos2[] = $item3;
        }
        $item2 = [
            "id" => $row2["id"],
            "titulo" => $row2["titulo"],
            "texto" => $row2["texto"],
            "editavel" => $row2["editavel"],
            "renomeavel" => $row2["renomeavel"],
            "subconteudos2" => $subconteudos2
        ];
        $subconteudos[] = $item2;
    }

    $item = [
        "id" => $row["id"],
        "titulo" => $row["titulo"],
        "texto" => $row["texto"],
        "editavel" => $row["editavel"],
        "subconteudos" => $subconteudos
    ];
    $conteudos[] = $item;
}

$consulta = "SELECT * FROM anexos WHERE id_artefato = '$id'";

$resultado = mysqli_query($conexao, $consulta);
$anexos = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $anexos[] = [
        "id" => $row["id"],
        "nome" => $row["nome"],
        "tipo" => $row["tipo"]
    ];
}

$consulta = "SELECT nome FROM artefatos WHERE id = '$id'";
$resultado = mysqli_query($conexao,$consulta);
if($row = mysqli_fetch_assoc($resultado)){
    $nomeArtefato = $row["nome"];
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
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>ControlRUP</title>
</head>
<body>
    <div class="container">
        <form action="../backend/salvarArtefato.php?id=<?php echo $id;?>&projeto=<?php echo $projeto;?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 pt-4">
                    <h2 class="text-center"><?php echo $nomeArtefato;?><h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 border border-dark pb-4 pt-3">
                    <div class="row">
                        <?php foreach ($conteudos as $key => $value) {?>
                            <div class="col-md-12">
                                <label for="resumo" class="form-label"><?php echo ($key+1)."-".$value["titulo"];?></label>
                                <textarea class="form-control" name="conteudo[<?php echo $value["id"];?>]" rows="3"><?php echo $value["texto"];?></textarea>
                            </div>
                            <?php if($value["editavel"]){
                                    $parametros = "'subconteudo','".$value["titulo"]."','".$value["id"]."'";   
                            ?>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-11 text-center p-md-3">
                                        <button type="button" class="btn btn-success col-md-6" data-bs-toggle="modal" data-bs-target="#adicionarTopico" onclick="novoTopico(<?php echo $parametros;?>)">Adcionar Tópico <?php echo ($key+1)."-".(sizeof($value["subconteudos"])+1);?></button>
                                    </div>
                            <?php };?>
                            <?php foreach ($value["subconteudos"] as $key2 => $subconteudo) {?>
                                <div class="col-md-1"></div>
                                <div class="col-md-11">
                                    <label for="resumo" class="form-label"><?php echo ($key+1)."-".($key2 + 1)."-".$subconteudo["titulo"];?></label>
                                    <?php if($subconteudo["renomeavel"]){
                                        $parametros2 = "'subconteudo','".$subconteudo["titulo"]."','".$subconteudo["id"]."','".$value["id"]."'";    
                                    ?>
                                        <button type="button" class="btn btn-primary pt-1 pb-1" data-bs-toggle="modal" data-bs-target="#adicionarTopico" onclick="editTopico(<?php echo $parametros2;?>)"><img src="images/edit.png" alt="Editar"></button>
                                        <a href="../backend/excluirsubconteudo.php?id=<?php echo $subconteudo['id'].'&artefato='.$id;?>&projeto=<?php echo $projeto;?>" class="btn btn-danger  pt-1 pb-1"><img src="images/delete.png" alt="Deletar"></a>
                                    <?php }?>
                                    <textarea class="form-control" name="subconteudo[<?php echo $subconteudo["id"];?>]" rows="3"><?php echo $subconteudo["texto"];?></textarea>
                                </div>
                                <?php if($subconteudo["editavel"]){
                                        $parametros3 = "'subconteudo2','".$subconteudo["titulo"]."','".$subconteudo["id"]."'";   
                                ?>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-center p-md-3">
                                            <button type="button" class="btn btn-primary col-md-6" data-bs-toggle="modal" data-bs-target="#adicionarTopico" onclick="novoTopico(<?php echo $parametros3;?>)">Adcionar Tópico <?php echo ($key+1)."-".($key2+1)."-".(sizeof($subconteudo["subconteudos2"])+1);?></button>
                                        </div>
                                <?php };?>
                                <?php foreach ($subconteudo["subconteudos2"] as $key3 => $subconteudo2) {?>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <label for="resumo" class="form-label"><?php echo ($key+1)."-".($key2 + 1)."-".($key3 + 1)."-".$subconteudo2["titulo"];?></label>
                                        <?php if($subconteudo2["renomeavel"]){
                                            $parametros3 = "'subconteudo2','".$subconteudo2["titulo"]."','".$subconteudo2["id"]."','".$subconteudo["id"]."'";    
                                        ?>
                                            <button type="button" class="btn btn-primary pt-1 pb-1" data-bs-toggle="modal" data-bs-target="#adicionarTopico" onclick="editTopico(<?php echo $parametros3;?>)"><img src="images/edit.png" alt="Editar"></button>
                                            <a href="../backend/excluirsubconteudo2.php?id=<?php echo $subconteudo2['id'].'&artefato='.$id;?>&projeto=<?php echo $projeto;?>" class="btn btn-danger  pt-1 pb-1"><img src="images/delete.png" alt="Deletar"></a>
                                        <?php }?>
                                        <textarea class="form-control" name="subconteudo2[<?php echo $subconteudo2["id"];?>]" rows="3"><?php echo $subconteudo2["texto"];?></textarea>
                                    </div>
                                <?php }?>    
                            <?php }?>    
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <label class="form-label">Imagens</label>
                        <input type="file" multiple name="imagens[]" id="imagens"/>
                        <div id="imagensCustum" onClick="defaultInputActive()" 
                            ondragenter="event.stopPropagation();event.preventDefault();"
                            ondragover="event.stopPropagation();event.preventDefault();"
                            ondrop="doDrop(event);"
                        >
                            <div id="imagensCustumInterna" class="row">
                                <span id="placeholderImagens">Clique para selecionar ou arraste os arquivos!</span>
                            </div>
                        </div>
                        <div id="alertaImagem" class="alert alert-danger d-none col-md-10" role="alert">
                            Tipo de imagem não aceita!
                        </div>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluirAnexos">Excluir Imagems Salvas</button>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <br><br><br>
                    <button type="submit" class="btn btn-primary col-md-6">Salvar</button>
                    <br><br>
                    <button type="button" onclick="confirmarSair(<?php echo $id.','.$projeto;?>)" class="btn btn-warning col-md-6">Cancelar</button>
                </div>
            </div>
        </form>
        <script src="editImagem.js"></script>
        <form action="../backend/excluirAnexos.php?id=<?php echo $id;?>&projeto=<?php echo $projeto;?>" method="post">
            <div class="modal fade" id="excluirAnexos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Excluir Imagens</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <label for="anexos">Selecione: </label>
                                <select class="p-2" name="anexos[]" id="anexos" multiple size="10">
                                    <?php 
                                        foreach ($anexos as $value) {
                                            $idAnexo = $value["id"];
                                            $nome = $value["nome"];
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
        <form action="../backend/adcionarItem.php?artefato=<?php echo $id;?>&projeto=<?php echo $projeto;?>" method="post">
            <div class="modal fade" id="adicionarTopico" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloAdcionar">Adcionar Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <label for="anexos" class="form-label">Nome do tópico: </label>
                                <input type="text" name="topico" id="topico" class="form-control" required>
                                <input type="hidden" name="tipo" id="tipo">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="topicoPrincipal" id="topicoPrincipal">
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
    </div>
    <br/><br/><br/>
    <script>
        function confirmarSair(id,projeto) {
            return swal({
                title: "Sair sem salvar!",
                icon: "error",
                closeOnClickOutside: false,
                closeOnEsc: false,
                text: "Deseja sair sem salvar!",
                buttons: {
                    cancel: {
                        text: "    Não   ",
                        value: false,
                        visible: true,
                        className: "btn btn-warning"
                    },
                    sim: {
                        text: "  Sim    ",
                        value: true,
                        visible: true,
                        className: "btn btn-danger"
                    }
                }
            })
            .then(response =>{
                if(response){
                    window.location.href = "viewArtefato.php?id=" + id+"&projeto=" + projeto;
                }
            })
        }

        function novoTopico(tipo, topicoPrincipal, id_topicoPrincipal) {
            var inputTipo = document.querySelector("#tipo");
            inputTipo.value = tipo;
            var tituloAdd = document.querySelector("#tituloAdcionar");
            tituloAdd.innerText = "Novo Tópico em " + topicoPrincipal;
            var topicoPrincipalId = document.querySelector("#topicoPrincipal");
            topicoPrincipalId.value = id_topicoPrincipal;
        }

        function editTopico(tipo, topico, id_topico, id_topicoPrincipal) {
            var inputTipo = document.querySelector("#tipo");
            inputTipo.value = tipo;
            var tituloAdd = document.querySelector("#tituloAdcionar");
            tituloAdd.innerText = "Editar nome do tópico " + topico;
            var topicoId = document.querySelector("#id");
            topicoId.value = id_topico;
            var topicoNome = document.querySelector("#topico");
            topicoNome.value = topico;
            var topicoPrincipalId = document.querySelector("#topicoPrincipal");
            topicoPrincipalId.value = id_topicoPrincipal;
        }
    </script>
</body>
</html>