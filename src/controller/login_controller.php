<?php

require_once "../../config.php";
require "../model/usuario.php";
require "../controller/session_on.php";

unset($_SESSION["erro"]);


if (isset($_POST["email_ou_telefone"])) {
    if (isset($_POST["senha"])) {
        $usuario = new Usuario();
        if ($usuario->login($_POST["email_ou_telefone"], $_POST["senha"])) {
            $_SESSION["usuario"] = $usuario->getObject();
            session_regenerate_id(true);
            header("Refresh: 0; URL = ../../index.php");
        } else {
            $_SESSION["erro"] = "login ou senha incorretos!";
            header("Refresh:0; URL = ../view/login.php");
        }
    } else {
        $_SESSION["erro"] = "Preencha o campo senha!";
        header("Refresh:0; URL = ../view/login.php");
    }
} else {
    $_SESSION["erro"] = "Preencha o campo login!";
    header("Refresh:0; URL = ../view/login.php");
}