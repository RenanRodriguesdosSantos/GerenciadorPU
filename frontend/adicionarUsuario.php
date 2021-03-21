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
    $projeto = $_GET["projeto"];

    require_once("../backend/conexao.php");

    $consulta = "SELECT u.user as nome, u.id FROM users u INNER JOIN users_projeto up ON (u.id = up.user) WHERE up.projeto = '$projeto'";
    $resultado = mysqli_query($conexao,$consulta);

    $usersAdd = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $usersAdd[] =[
            "id" => $row["id"],
            "nome" => $row["nome"]
        ];
    }

    $consulta = "SELECT u.user as nome, u.id FROM users u LEFT JOIN users_projeto up ON (u.id = up.user) INNER JOIN projeto p ON (p.id = up.projeto) WHERE up.user IS NULL AND p.id = '$projeto'";
    $resultado = mysqli_query($conexao,$consulta);

    $users = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $users[] =[
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
       <title>Contro RUP</title>
   </head>
   <body>
       <div class="container">
            <div class="row">
                <h2 class="text-center">Adicionar Usuário ao Projeto</h2>
            </div>
            <div class="row">
                <h3>Usuário já adicionados: </h3>
                <br><br><br>
                <ul>
                    <?php foreach ($usersAdd as $key => $value) { ?>
                        <li><h4><?php echo $value["id"]." - ".$value["nome"]?></h4></li>
                    <?php }?>
                </ul>
            </div>
            <div class="row">
                <h3>Adicionar: </h3>
                <br><br><br>
                <form action="../backend/adicionarUser.php?projeto=<?php echo $projeto;?>" method="post"></form>
                    <div class="col-md-5">
                        <select name="usuario" id="usuario" class="form-control" requered>
                            <?php foreach ($users as $key => $value) { ?>
                                    <option value="<?php echo $value["id"];?>"><?php echo $value["nome"];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-7"></div>
                    
                    <button type="submit" class="btn btn-primary col-md-5 mt-2"> Adicionar </button>
                </form>
            </div>
            <div class="col-md-5 mt-5">
                <a href="projetos.php" class="btn btn-warning col-md-12">Voltar</a>
            </div>
       </div>
   </body>
   </html>
   <?php
}
else{
    echo "<h1>Você não tem permissão adicionar Usuário!</h1>";
    echo "<h2><a href='../frontend/projeto.php'>Voltar</a></h2>";
}