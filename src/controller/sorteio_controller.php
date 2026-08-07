<?php

require "../model/rifa.php";
// require "../model/numeroComprado.php";
require_once "../../config.php";

header('Content-Type: application/json; charset=utf-8');
if (isset($_POST["id_rifa"])) {
    if (isset($_POST["numeros_comprados"])) {
        $somenteNumerosComprados = true;
    } else {
        $somenteNumerosComprados = false;
    }

    $rifa = new Rifa();
    $numeroComprado = new NumeroComprado();
    // $db = new Database();

    $numeroSorteado = $rifa->sortearNumero($_POST["id_rifa"], $somenteNumerosComprados);
    $listaNumerosComprados = $numeroComprado->listarNumerosCompradosDaRifa($_POST["id_rifa"]);
    $numeroFoiComprado = $numeroComprado->verificaNumeroComprado($_POST["id_rifa"], $numeroSorteado);
    // var_dump($listaNumerosComprados->numero);

    if ($somenteNumerosComprados) {
        echo json_encode([
            'status' => 'sucesso',
            'numeroSorteado' => $numeroSorteado,
            'numerosComprados' => $listaNumerosComprados
        ]);
        exit;
    } else {
        $quantidadeNumeros = $rifa->getQuantidadeDeNumerosPorId($_POST["id_rifa"]);
        echo json_encode([
            'status' => 'sucesso',
            'numeroSorteado' => $numeroSorteado,
            'quantidadeNumeros' => $quantidadeNumeros,
            'numeroFoiComprado' => $numeroFoiComprado
        ]);
        exit;
    }

    // header("Refresh:0; URL= ../view/galeria_rifas.php");
} else {

    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Preencha todos os campos!'
    ]);
    exit;
}