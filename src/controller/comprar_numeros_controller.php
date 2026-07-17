<?php

require_once "../../config.php";
// require "../model/database.php";
require "../model/usuario.php";
// require "../model/usuario.php";
require "../controller/session_off.php";

$db = new Database();

// // var_dump($usuario);

if (isset($_POST["numeros"])) {
    // var_dump($_POST["numeros"]);
    echo "Os números são:";
    var_dump($_POST["numeros"]);
}

if (isset($_POST["id_rifa"])) {
    // var_dump($_POST["id_rifa"]);
    echo "O Id da Rifa é: {$_POST['id_rifa']}";
}

if (isset($_POST["id_usuarios_temp"])) {
    // var_dump($_POST["id_usuario"]);
    echo "O Id do Usuário Temp é: {$_POST['id_usuarios_temp']}";
}

if (isset($_POST["id_usuario"])) {
    // var_dump($_POST["id_usuario"]);
    echo "O Id do Usuário é: {$_POST['id_usuario']}";
}


if (isset($_POST["numeros"]) && isset($_POST["id_rifa"])) {
    $numeros = $_POST["numeros"];
    $idRifa = $_POST["id_rifa"];

    if (isset($_POST["id_usuario"])  && $_POST["id_usuario"] != null) {
        $idUsuario = $_POST["id_usuario"];

        foreach ($numeros as $n) {
            $db->insert(
                "INSERT INTO numeros_comprados(numero, id_rifa, id_usuario) VALUES($n, $idRifa, $idUsuario)"
            );
        }

        header("Refresh:0, URL= ../../index.php");

    } else {

        $idUsuario = $_POST["id_usuarios_temp"];

        foreach ($numeros as $n) {
            $db->insert(
                "INSERT INTO numeros_comprados(numero, id_rifa, id_usuarios_temp) VALUES($n, $idRifa, $idUsuario)"
            );
        }
        header("Refresh:0, URL= ../view/galeria_rifas.php");
    }
}
