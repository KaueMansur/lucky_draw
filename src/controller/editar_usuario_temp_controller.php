<?php

require "../model/usuarioTemporario.php";
require_once "../../config.php";

if(isset($_POST["nome_usuario_temp"])){
    if(isset($_POST["tel_usuario_temp"]) && isset($_POST["id_usuarios_temp"])){
        $usuarioTemp = new UsuarioTemporario();

        $usuarioTemp->editarUsuarioTemporario($_POST["id_usuarios_temp"], $_POST["nome_usuario_temp"], $_POST["tel_usuario_temp"]);
    } else{
        echo "Erro no id ou no telefone";
    }
} else{
    echo "Erro no nome";
}

header("Refresh:0; URL= ../view/galeria_rifas.php");    
?>