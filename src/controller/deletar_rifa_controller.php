<?php

require "../model/rifa.php";
require_once "../../config.php";

if(isset($_POST["id_rifa"])){
    $rifa = new Rifa();
    $usuarioTemp = new UsuarioTemporario();

    $usuarioTemp->excluirTodosUsuariosTempDaRifa($_POST["id_rifa"]);
    $rifa->deletarRifa($_POST["id_rifa"]);
}

header("Refresh:0, URL= ../view/galeria_rifas.php");

?>