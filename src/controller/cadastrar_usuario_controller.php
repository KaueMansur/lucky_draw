<?php
require "../model/usuario.php";

if (isset($_POST["nome"])) {
    if (isset($_POST["telefone"]) || isset($_POST["email"]) && isset($_POST["senha"]) && isset($_POST["senha_confirm"])) {
        if ($_POST["senha"] == $_POST["senha_confirm"]) {
            $usuario = new Usuario();
            $usuario->cadastrarUsuario($_POST["nome"], $_POST["telefone"], $_POST["email"], $_POST["senha"]);

            header("Refresh:0; URL= ../view/login.html");
        }
    }
}
