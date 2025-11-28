<?php
require "../model/usuario.php";

if (isset($_POST["nome"])) {
    if (isset($_POST["telefone"]) || isset($_POST["email"]) && isset($_POST["senha"]) && isset($_POST["senha_confirm"])) {
        if ($_POST["senha"] == $_POST["senha_confirm"]) {
            $usuario = new Usuario();
            $usuario->cadastrarUsuario($_POST["nome"], $_POST["telefone"], $_POST["email"], $_POST["senha"]);

            header("Refresh:0; URL= login.php");
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
    <title>Cadastro</title>
</head>

<body id="body_login">

    <form action="#" method="post" class="form_login">
        <h1 class="titulo txt_left">Cadastre-se</h1>
        <P class="txt_secundario" style="margin-bottom: 25px;">Crie sua conta agora</P>

        <div class="div_campo_login">
            <label for="" class="label_login login">Nome</label>
            <input type="text" name="nome" id="" class="input_login">
        </div>

        <div class="div_campo_login">
            <label for="telefone" class="label_login login">Telefone</label>
            <input type="tel" name="telefone" id="telefone" class="input_login">
        </div>

        <div class="div_campo_login">
            <label for="" class="label_login login">Email</label>
            <input type="email" name="email" id="" class="input_login">
        </div>

        <div class="div_campo_login">
            <label for="" class="label_login login">Senha</label>
            <input type="password" name="senha" id="" class="input_login">
        </div>

        <div class="div_campo_login">
            <label for="" class="label_login login">Confirme sua senha</label>
            <input type="password" name="senha_confirm" id="" class="input_login">
        </div>
        
        <input type="submit" value="Cadastrar" class="btn_form">
        <p class="txt_secundario">Já tem conta? <a href="login.php" class="link">Faça login</a></p>
    </form>
    <script src="../../assets/js/mascaras.js"></script>
</body>

</html>