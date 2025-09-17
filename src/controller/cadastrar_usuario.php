<?php

require "../model/usuario.php";

if(isset($_POST["nome"])){
    if(isset($_POST["telefone"]) && $_POST["id_rifa"]){
        $usuario = new usuario();

        $usuario->cadastrarUsuario($_POST["nome"], $_POST["telefone"], null, null, $_POST["id_rifa"]);
        header("Refresh:0, URL= ../view/galeria_rifas.php");
    }
}


?>