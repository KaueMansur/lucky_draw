<?php

// require "src/model/usuario.php";

require "src/model/rifa.php";

session_start();

if(isset($_SESSION["usuario"])){
    $usuario = $_SESSION["usuario"];
}

$rifa = new Rifa();

$listaDeRifas = $rifa->listarTodasAsRifas();

$listaDasRifas = [];

foreach($listaDeRifas as $r){
    array_push($listaDasRifas, $rifa = new Rifa($r->id_rifa, $r->objetivo, $r->quantidade_de_numeros, $r->premio, $r->imagem_ilustrativa, $r->data_do_sorteio, $r->local_do_sorteio, $r->valor_cada_numero, $r->valor_total, $r->id_usuario, $r->privacidade));
}

// var_dump($listaDasRifas);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>página principal</title>
    <style>
        .rifas{
            width: 400px;
            height: 150px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <h1>Pg inicial Rifas</h1>
    <?php if(!isset($_SESSION["usuario"])){ ?>
        <a href="src/view/login.php">Login</a>
        <?php } else{ ?>
            <a href="src/controller/session_destroy.php">Sair da sessão</a>
            <h1><?= $usuario->getIdUsuario() ?></h1>
            <a href="src/view/galeria_rifas.php">Galeria de rifas</a>
        <?php } ?>
    <form action="#" method="post">
        <input type="text" name="" id="">
    </form>
    <select name="" id="">
        <option value="">1</option>
        <option value="">2</option>
        <option value="">3</option>
    </select>
    <a href="src/view/criarRifa.php">Criar Rifa</a>
     <section style="background-color: #695353ff; width: 100wh; height: 550px; padding: 50px;">

        <ul style="display: flex; flex-wrap: wrap; gap: 20px;">
            <?php foreach($listaDasRifas as $rifa){ ?>
                <li class="rifas">
                    <p><?= $rifa->getObjetivo() ?></p>
                    <p><?= $rifa->getPremio() ?></p>
                    <p><?= number_format($rifa->getValorCadaNumero(), 2, '.') ?></p>
                </li>
            <?php } ?>
        </ul>

    </section>
</body>
</html>