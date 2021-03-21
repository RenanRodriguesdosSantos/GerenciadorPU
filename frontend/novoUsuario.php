<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: ../index.php");
}
$admin = $_SESSION["admin"];

if($admin){
    require_once("../backend/conexao.php");

    $consulta = "SELECT user as nome, id, admin, email  FROM users";
    $resultado = mysqli_query($conexao,$consulta);

    $users = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $users[] =[
            "id" => $row["id"],
            "nome" => $row["nome"],
            "admin" => $row["admin"],
            "email" => $row["email"]
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
</head>
<body>
    <div class="container">
        <div class="row">
            <h3>Usuarios: </h3>
            <br><br><br>
            <ul>
                <?php foreach ($users as $key => $value) { 
                    $parametros = "'".$value["nome"]."','".$value["email"]."','".$value["admin"]."','".$value["id"]."'";
                    ?>
                    <li><h4><?php echo $value["id"]." - ".$value["nome"]?><button type="button" class="btn btn-success border" data-bs-toggle="modal" data-bs-target="#editUsuario" onclick="editUser(<?php echo $parametros;?>)">Editar</button></h4></li>
                <?php }?>
            </ul>
        </div>
        <div class="row">
            <button type="button" class="btn btn-success col-md-4 border" data-bs-toggle="modal" data-bs-target="#editUsuario">Novo Usuário</button>
                <form action="../backend/gerirUser.php" method="post">
                    <div class="modal fade" id="editUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content text-start">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tituloAdcionar">Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <label for="nome" class="form-label">Nome do Usuario: </label>
                                        <input type="text" name="nome" id="nome" class="form-control" required placeholder="Nome do Usuário">
                                        <input type="hidden" name="id" id="id">
                                    </div>
                                    <div class="row">
                                        <label for="email" class="form-label">Email: </label>
                                        <input type="email" name="email" id="email" class="form-control" required placeholder="email@exemplo.com" required>
                                    </div>
                                    <div class="row">
                                        <label for="email" class="form-label">Senha: </label>
                                        <input type="password" name="senha" id="senha" class="form-control" required placeholder="Senha" required>
                                    </div>
                                    <div class="row">
                                        <label for="admin" class="form-label">Admin: &nbsp; <input type="checkbox" name="admin" id="admin" value='1'></label>
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
        <div class="row">
            <div class="col-md-5 mt-5">
                <a href="projetos.php" class="btn btn-warning col-md-12">Voltar</a>
            </div>
        </div>
    </div>
    <script>
        function editUser(nome,email,admin,id) {
            var campoNome = document.querySelector("#nome");
            var campoId = document.querySelector("#id");
            var campoEmail = document.querySelector("#email");
            var campoAdmin = document.querySelector("#admin");
            campoNome.value = nome;
            campoEmail.value = email;
            campoId.value = id;
            campoAdmin.checked = admin == 1?true:false;
        }
    </script>  
</body>
</html>

<?php }
else{
    echo "<h1>Você não tem permissão para salvar um Usuário!</h1>";
    echo "<h2><a href='../frontend/projetos.php'>Voltar</a></h2>";
}
?>