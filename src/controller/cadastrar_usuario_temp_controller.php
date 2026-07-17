<?php

require "../model/usuario.php";

require_once "../../config.php";

if(isset($_POST["nome"])){
    if(isset($_POST["telefone"]) && $_POST["id_rifa"]){
        $usuarioTemp = new UsuarioTemporario();

        $usuarioTemp->cadastrarUsuarioTemporario($_POST["nome"], $_POST["telefone"], $_POST["id_rifa"]);
        header("Refresh:0, URL= ../view/galeria_rifas.php");
    }
}


?>