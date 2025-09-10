<?php
    require "../model/usuario.php";

    if(isset($_POST["nome"])){
        if(isset($_POST["telefone"]) || isset($_POST["email"]) && isset($_POST["senha"]) && isset($_POST["senha_confirm"])){
            if($_POST["senha"] == $_POST["senha_confirm"]){
                $usuario = new Usuario();
                $usuario->cadastrarUsuario($_POST["nome"],$_POST["telefone"], $_POST["email"], $_POST["senha"]);

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
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastre-se</h1>

    <form action="#" method="post">

        <label for="">Nome:</label>
        <input type="text" name="nome" id="">

        <label for="">Telefone:</label>
        <input type="tel" name="telefone" id="">

        <label for="">Email:</label>
        <input type="email" name="email" id="">

        <label for="">Senha:</label>
        <input type="password" name="senha" id="">

        <label for="">Confirme sua senha:</label>
        <input type="password" name="senha_confirm" id="">

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>