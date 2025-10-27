<?php

require "../model/usuario.php";
require "../controller/session_on.php";


if (isset($_POST["email_ou_telefone"])) {
    if (isset($_POST["senha"])) {
        $usuario = new Usuario();
        if ($usuario->login($_POST["email_ou_telefone"], $_POST["senha"])) {
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
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Login</title>
</head>

<body id="body_login">
    <!--<a href="./recuperar_senha.php">Esqueci minha senha</a> -->
    
    <form action="#" method="post" class="form_login">
        <h1 class="titulo txt_left">Login</h1>
        <P class="txt_secundario" style="margin-bottom: 25px;">Bem vindo de volta</P>

        <div class="div_campo_login">
            <label for="" class="label_login">E-mail ou telefone</label>
            <input type="text" name="email_ou_telefone" class="input_login" id="">
        </div>

        <div class="div_campo_login">
            <label for="" class="label_login">Senha</label>
            <input type="password" name="senha" class="input_login" id="">
        </div>

        <input type="submit" value="Entrar" class="btn_form">
        <p class="txt_secundario">Não tem conta? <a href="cadastro.php" class="link">Cadastre-se aqui</a></p>

    </form>
</body>

</html>