<?php


require "../model/rifa.php";

require "../controller/session_off.php";

$rifa = new Rifa();

$usuario = $_SESSION["usuario"];


$listaDeRifas = $rifa->listarTodasAsRifas($usuario->getIdUsuario());

$listaDasRifas = [];

foreach($listaDeRifas as $r){
    array_push($listaDasRifas, $rifa = new Rifa($r->id_rifa, $r->objetivo, $r->quantidade_de_numeros, $r->premio, $r->imagem_ilustrativa, $r->data_do_sorteio, $r->local_do_sorteio, $r->valor_cada_numero, $r->valor_total, $r->id_usuario, $r->privacidade));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .rifas{
            width: 400px;
            height: 150px;
            background-color: #fff;
        }

        .rifa_aberta{
            display: none;
            position: fixed;
            top: 10px;
            left: 200px;
            width: 1000px;
            height: 600px;
            background-color: #fff;
            border: 1px solid #000;
        }
    </style>
    <title>Galeria de Rifas</title>
</head>
<body>
    <h1>Galeria de rifas</h1>
    <a href="../../index.php">Voltar à página inicial</a>
    <section style="background-color: #695353ff; width: 100wh; height: 550px; padding: 50px;">

        <ul>
            <?php foreach($listaDasRifas as $rifa){ ?>
                <li class="rifas">
                    <p><?= $rifa->getObjetivo() ?></p>
                    <p><?= $rifa->getPremio() ?></p>
                    <p><?= number_format($rifa->getValorCadaNumero(), 2, '.') ?></p>
                    <button onclick="abrirRifa(<?= $rifa->getIdRifa() ?>)">Abrir Rifa</button>
                </li>
                <div class="rifa_aberta" id="id<?= $rifa->getIdRifa() ?>">
                    <button onclick="fecharRifa(<?= $rifa->getIdRifa() ?>)">Fechar Rifa</button>
                </div>
            <?php } ?>
        </ul>

    </section>
    <script src="../../assets/js/script.js"></script>
</body>
</html>