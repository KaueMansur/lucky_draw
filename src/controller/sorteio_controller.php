<?php

require_once "../../config.php";
require "../model/rifa.php";

// if (isset($_POST["id_rifa"])) {
    // var_dump($_POST["id_rifa"]);
// }

// if (isset($_POST["numeros_comprados"])) {
//     var_dump($_POST["numeros_comprados"]);
// }

if (isset($_POST["id_rifa"])) {
    if (isset($_POST["numeros_comprados"])) {
        $somenteNumerosComprados = true;
    } else {
        $somenteNumerosComprados = false;
    }

    // var_dump($somenteNumerosComprados);
    $rifa = new Rifa();
    $db = new Database();

    // var_dump($somenteNumerosComprados);

    $numerosSorteio = $rifa->sortearNumero($_POST["id_rifa"], $somenteNumerosComprados);

    header("Refresh:0; URL= ../view/galeria_rifas.php");
    echo "Erro no If(numeros_comprados)";
};
