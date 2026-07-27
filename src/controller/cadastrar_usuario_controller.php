<?php
require "../model/usuario.php";
require_once "../../config.php";

unset($_SESSION["erro"]);

if (isset($_POST["nome"])) {
    if (isset($_POST["telefone"]) || isset($_POST["email"])) {
        if (isset($_POST["senha"]) && isset($_POST["senha_confirm"])) {
            if ($_POST["senha"] == $_POST["senha_confirm"]) {
                $usuario = new Usuario();
                // $senhaSegura = $_POST["senha"];
                $usuario->cadastrarUsuario($_POST["nome"], $_POST["telefone"], $_POST["email"], $_POST["senha"]);

                header("Refresh:0; URL= ../view/login.php");
                exit;
            } else{
                $_SESSION["erro"] = "As senhas devem ser iguais!";
                header("Refresh: 0; URL = ../view/cadastro.php");
            }
        } else{
            $_SESSION["erro"] = "Preencha todos os campos obrigatórios!";
            header("Refresh: 0; URL = ../view/cadastro.php");
        }
    } else{
        $_SESSION["erro"] = "Preencha o campo telefone ou usuário!";
        header("Refresh: 0; URL = ../view/cadastro.php");
    }
} else{
    $_SESSION["erro"] = "Preencha todos os campos obrigatórios!";
    header("Refresh: 0; URL = ../view/cadastro.php");
}