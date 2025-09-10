<?php

// require "../model/usuario.php";
// require "../model/database.php";
require "../model/numeroComprado.php";
// require "../model/usuario.php";
require "../controller/session_off.php";

$db = new Database();

// var_dump($usuario);

if(isset($_GET["numeros"]) && isset($_GET["id_rifa"])){
    $numeros = $_GET["numeros"];
    $idRifa = $_GET["id_rifa"];
    $idUsuario = $_GET["id_usuario"];

    foreach($numeros as $n){
        $db->insert(
            "INSERT INTO numeros_comprados(numero, id_rifa, id_usuario) VALUES($n, $idRifa, $idUsuario)"
        );
    }

    header("Refresh:0, URL= ../../index.php");
    // var_dump($_GET["numeros"]);
}

?>