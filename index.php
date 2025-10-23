<?php

// require "src/model/usuario.php";

require "src/model/rifa.php";

session_start();

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
}

$rifa = new Rifa();

$listaDeRifas = $rifa->listarTodasAsRifas();

$listaDasRifas = [];

foreach ($listaDeRifas as $r) {
    array_push($listaDasRifas, $rifa = new Rifa($r->id_rifa, $r->objetivo, $r->quantidade_numeros, $r->premio, $r->imagem_ilustrativa, $r->data_sorteio, $r->local_sorteio, $r->valor_cada_numero, $r->valor_total, $r->id_usuario, $r->privacidade, $r->numero_sorteado, $r->status_vendas));
}

// var_dump($listaDasRifas);
$numeroComprado = new NumeroComprado();



foreach ($listaDasRifas as $rifa) {

    $listaDeNumerosComprados = $numeroComprado->listarNumerosCompradosDaRifa($rifa->getIdRifa());

    $listaNumeros = $numeroComprado->listarTodosOsNumerosDaRifa($rifa->getIdRifa());


    // foreach($listaNumeros as $numero){
    //     foreach($listaDeNumerosComprados as $numeroV){
    //         if($numero == $numeroV){
    //             //Número foi vendido
    //             $numerosDaRifa = [$numero => "vendido"];
    //         } else{
    //             //Número está disponível
    //             $numerosDaRifa = [$numero => "disponivel"];
    //         }
    //     }
    // }


    // $listaFinal = $numeroComprado->criarArrayAssociativo($listaNumeros, $listaDeNumerosComprados);

    // var_dump($listaFinal);             
    // var_dump($listaNumeros);               
    // var_dump($listaNumeros);
}





?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>página principal</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .rifas {
            width: 400px;
            height: 150px;
            background-color: #fff;
        }

        .rifa_aberta {
            display: none;
            position: fixed;
            top: 10px;
            left: 200px;
            width: 900px;
            min-height: 600px;
            background-color: #fff;
            border: 1px solid #000;
            padding: 5px;
        }

        .espaco_numeros {
            background-color: #413636ff;
            width: 95%;
            height: 80%;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            padding: 10px;
            overflow: scroll;
        }

        .numero {
            background-color: #fff;
            width: 40px;
            height: 40px;
            list-style-type: none;
        }

        .numero_vendido {
            background-color: #e91111ff;
        }
    </style>
</head>

<body>
    <header>

        <nav id="nav">
            <h2 class="logo">LuckyDraw</h2>
            <ul class="ul_nav">
                <li><a href="#" class="nav_links">Home</a></li>
                <li><a href="#" class="nav_links">About</a></li>
                <li><a href="#" class="nav_links">Tickets</a></li>
                <li><a href="#" class="nav_links">Results</a></li>
                <li><a href="#" class="nav_links">Contact</a></li>
            </ul>
            <ul class="ul_nav">
                <li><a class="btn_nav" href="src/view/criarRifa.php">Criar Rifa</a></li>
                <?php if (!isset($_SESSION["usuario"])) { ?>
                    <li><a class="btn_nav" href="src/view/login.php">Login</a></li>
                <?php } else { ?>
                    <li><a class="btn_nav" href="src/controller/session_destroy.php">Sair da sessão</a></li>
                    <li><a class="btn_nav" href="src/view/galeria_rifas.php">Galeria de rifas</a></li>
                <?php } ?>
            </ul>
        </nav>
        <section id="hero">
            <article class="hero_content">
                <h1 class="titulo">Win Big Prizes!</h1>
                <p>Buy your tickets and have a chance to win amazing prizes</p>
                <div>
                    <a class="btn_nav" href="#">View Prizes</a>
                    <a class="btn_nav white" href="#">Buy Tickets</a>
                </div>
            </article>
        </section>
        <section id="diferencial">
            <h2 class="subtitulo">Why Choose Us?</h2>
            <div id="cards_diferencial_container">
                <article class="card_diferencial">
                    <img src="" alt="">
                    <h3>Easy to Play</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime, aut?</p>
                </article>
                <article class="card_diferencial">
                    <img src="" alt="">
                    <h3>Easy to Play</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime, aut?</p>
                </article>
                <article class="card_diferencial">
                    <img src="" alt="">
                    <h3>Easy to Play</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime, aut?</p>
                </article>
                <article class="card_diferencial">
                    <img src="" alt="">
                    <h3>Easy to Play</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime, aut?</p>
                </article>
            </div>
        </section>
    </header>

    <main>
        <h3>Upcoming prizes</h3>

        <section style="background-color: #695353ff; width: 100wh; height: 550px; padding: 50px;">

            <ul>
                <?php foreach ($listaDasRifas as $rifa) { ?>
                    <li class="rifas">
                        <p><?= $rifa->getObjetivo() ?></p>
                        <p><?= $rifa->getPremio() ?></p>
                        <p><?= number_format($rifa->getValorCadaNumero(), 2, '.') ?></p>
                        <?php if ($rifa->getImagemIlustrativa() != null) { ?>
                            <img src="<?= $rifa->getImagemIlustrativa() ?>" alt="img_ilustrativa" width="100px">
                        <?php } ?>
                        <button onclick="abrirRifa(<?= $rifa->getIdRifa() ?>)">Abrir Rifa</button>
                    </li>
                    <div class="rifa_aberta" id="id<?= $rifa->getIdRifa() ?>">
                        <button onclick="fecharRifa(<?= $rifa->getIdRifa() ?>)">Fechar Rifa</button>
                        <form action="src/controller/comprar_numeros_controller.php" method="post">
                            <ul class="espaco_numeros">
                                <?php


                                $numerosDaRifa = $numeroComprado->listarNumerosCompradosDaRifa($rifa->getIdRifa());

                                $numerosConvertidos = [];


                                for ($i = 0; $i < count($numerosDaRifa); $i++) {
                                    // $numerosConvertidos = [$numerosDaRifa[$i]];
                                    array_push($numerosConvertidos, $numerosDaRifa[$i]->numero);
                                }


                                for ($i = 1; $i < $rifa->getQuantidadeDeNumeros() + 1; $i++) {
                                    if (in_array($i, $numerosConvertidos)) {
                                        //Número vendido
                                ?>

                                        <label>
                                            <li class="numero numero_vendido">
                                                <?= $i;
                                                if ($rifa->getStatusVendas() == 1) {
                                                ?>
                                                    <input type="checkbox" value="<?= $i  ?>" checked disabled>
                                                <?php } ?>
                                            </li>
                                        </label>
                                    <?php } else { ?>
                                        <label>
                                            <li class="numero">
                                                <?= $i;
                                                if ($rifa->getStatusVendas() == 1) {
                                                ?>
                                                    <input type="checkbox" name="numeros[]" value="<?= $i  ?>" class="numeros_rifa_disponeis">
                                                <?php } ?>
                                            </li>
                                        </label>
                                <?php }
                                } ?>
                            </ul>

                            <?php if ($rifa->getStatusVendas() == 1) {  ?>

                                <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">
                                <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario() ?>">
                                <input type="submit" value="Comprar Números" id="btn_comprar_numeros<?= $rifa->getIdRifa() ?>" class="btn_comprar_numeros" disabled>
                                <button type="button" class="btn_limpar_selecao" disabled>Limpar Seleções</button>
                            <?php } ?>
                        </form>
                        <?php $numerosDoUsuario = $usuario->listarNumerosDoUsuarioDaRifa($usuario->getIdUsuario(), $rifa->getIdRifa());
                        // var_dump($numerosDoUsuario);
                        ?>
                        <p>Seus números:</p>
                        <ul>
                            <?php
                            foreach ($numerosDoUsuario as $numero) {
                            ?>
                                <li><?= $numero->numero ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php }
                ?>
            </ul>

        </section>
    </main>

    <footer>
        <article>
            <h4>About LuckyDraw</h4>
            <p>Lorem ipsum dolor sit amet.</p>
        </article>
        <article>
            <h4>About LuckyDraw</h4>
            <p>Lorem ipsum dolor sit amet.</p>
        </article>
        <article>
            <h4>About LuckyDraw</h4>
            <p>Lorem ipsum dolor sit amet.</p>
        </article>
        <article>
            <h4>About LuckyDraw</h4>
            <p>Lorem ipsum dolor sit amet.</p>
        </article>
        <hr>
        <p>Lorem ipsum dolor sit amet.</p>
    </footer>


    <script src="assets/js/script.js"></script>
</body>

</html>