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