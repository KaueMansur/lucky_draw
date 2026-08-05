<?php

require "../model/usuario.php";
require "../controller/session_off.php";
require_once "../../config.php";

$db = new Database();

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