<!DOCTYPE html>
<html>
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
    <body>

<?php
include_once("conexao.php");

/*if(isset($_GET['erro']))
{
		if($_GET['erro'] == 'senha'){ // se for erro de login e senha
			echo "<div class='alert alert-danger'>Login ou senha incorretos!</div><hr>";
		}
}*/

?>

        <div class="main">
            <img src="images/main.png" alt="RUP" class='rounded mx-auto d-block'>
            <div class="main" id="title">
                Login
            </div>
            <form action="logar.php" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Usuário</label>
                    <input type="text" class="form-control" name="user">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>
    </body>
</html>