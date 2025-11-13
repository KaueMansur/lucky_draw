<?php
require "../model/usuarioTemporario.php";

if (isset($_POST["id_usuario"])) {
    $usuarioTemp = new UsuarioTemporario();

    $usuarioTemp->excluirUsuarioTemp($_POST["id_usuario"]);
}

header("Refresh: 0, URL= ../view/galeria_rifas.php");