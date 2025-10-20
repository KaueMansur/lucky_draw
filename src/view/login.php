<?php

require "../model/usuario.php";
require "../controller/session_on.php";


if(isset($_POST["email_ou_telefone"])){
    if(isset($_POST["senha"])){
        $usuario = new Usuario();
        if($usuario->login($_POST["email_ou_telefone"], $_POST["senha"])){
            $_SESSION["usuario"] = $usuario->getObject();
            header("Refresh: 0; URL = ../../index.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Pg Login</h1>
    <a href="cadastro.php">Cadastre-se</a>
    <br>
    <a href="./recuperar_senha.php">Esqueci minha senha</a>

    <form action="#" method="post">

        <label for="">Email ou telefone:</label>
        <input type="text" name="email_ou_telefone" id="">

        <label for="">Senha:</label>
        <input type="password" name="senha" id="">

        <input type="submit" value="Login">

    </form>
</body>
</html>