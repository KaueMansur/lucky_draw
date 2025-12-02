<?php

// require "src/model/usuario.php";

require "src/model/rifa.php";

session_start();

$idsRifas = null;

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $idsRifas = $usuario->listarRifasComNumerosDoUsuario($usuario->getIdUsuario());
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
    <link rel="stylesheet" href="assets/css/responsividade.css">
</head>

<body>
    <header id="header">

        <nav id="nav">
            <h2 class="logo">LuckyDraw</h2>
            <ul class="ul_nav nav">
                <li><a href="#header" class="nav_links">Início</a></li>
                <li><a href="#footer" class="nav_links">Sobre</a></li>
                <li><a href="#main" class="nav_links">Rifas</a></li>
                <li><a href="#footer" class="nav_links">Contatos</a></li>
                <?php if (isset($_SESSION["usuario"])) { ?>
                    <li class="nav_links" onclick="abrirRifasCompradas()">Seus Números</li>
                    <aside class="desativado" id="menu_rifas_compradas">
                        <ul class="lista_rifas_compradas">
                            <?php foreach ($idsRifas as $rifasCompradas) {
                                $numeroSorteado = $rifa->converterIdEmRifa($rifasCompradas->id_rifa)[0]->numero_sorteado;
                                if (!isset($numeroSorteado)) { ?>
                                    <li class="nav_links rifas_compradas" onclick="abrirNumerosComprados(<?= $rifasCompradas->id_rifa ?>)"><?= $rifa->converterIdEmRifa($rifasCompradas->id_rifa)[0]->premio ?></li>
                                <?php } else { ?>
                                    <li class="rifas_compradas_li" onclick="abrirNumerosComprados(<?= $rifasCompradas->id_rifa ?>)">
                                        <?php
                                        $numerosCompradosDoUsuario = $usuario->listarNumerosDoUsuarioDaRifa($usuario->getIdUsuario(), $rifasCompradas->id_rifa);

                                        $listaNumerosCompradosDoUsuario = [];

                                        foreach($numerosCompradosDoUsuario as $numero){
                                            array_push($listaNumerosCompradosDoUsuario, $numero->numero);
                                        }
                                        // var_dump($numerosCompradosDoUsuario);
                                        if (in_array($numeroSorteado, $listaNumerosCompradosDoUsuario)) {
                                        ?>
                                            <span class="numero_sorteado vencedor"><?= $numeroSorteado ?></span>
                                        <?php } else { ?>
                                            <span class="numero_sorteado perdedor"><?= $numeroSorteado ?></span>
                                            <?php } ?>
                                        <span class="nav_links rifas_compradas rifas_compradas_sorteadas"><?= $rifa->converterIdEmRifa($rifasCompradas->id_rifa)[0]->premio ?></span>
                                    </li>
                                <?php } ?>
                                <aside class="desativado menu_numeros_comprados" id="menu_numeros_comprados<?= $rifasCompradas->id_rifa ?>">
                                    <ul class="lista_numeros_comprados">
                                        <?php foreach ($usuario->listarNumerosDoUsuarioDaRifa($usuario->getIdUsuario(), $rifasCompradas->id_rifa) as $numero) { ?>
                                            <li class="numero numeros_comprados"><?= $numero->numero ?></li>
                                        <?php } ?>
                                    </ul>
                                </aside>
                            <?php } ?>
                        </ul>
                    </aside>
                <?php } ?>
                <!-- <li><a href="#" class="nav_links">Results</a></li> -->
            </ul>
            <ul class="ul_nav">
                <?php if (!isset($_SESSION["usuario"])) { ?>
                    <li><a class="btn_nav" href="src/view/login.html">Login</a></li>
                <?php } else { ?>
                    <li><a class="btn_nav" href="src/controller/session_destroy.php">Sair da sessão</a></li>
                <?php } ?>
            </ul>
        </nav>
        <section id="hero">
            <li class="hero_content">
                <button class="btn_menu_hamburguer" onclick="abrirMenu()">
                    <svg width="40" height="45" viewBox="0 0 45 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="5" rx="3" fill="#564141" id="bar1" />
                        <rect y="10" width="40" height="5" rx="3" fill="#564141" id="bar2" />
                        <rect y="20" width="40" height="5" rx="3" fill="#564141" id="bar3" />
                    </svg>

                    <!-- <img src="assets/img/icons/btn_menu_hamburguer.svg" id="btn_menu_haburguer" height="25px" alt="" > -->
                </button>
                <aside class="menu_hamburguer" id="menu_hamburguer">
                    <ul class="ul_nav menu">
                        <li><a href="#header" class="nav_links">Início</a></li>
                        <li><a href="#footer" class="nav_links">Sobre</a></li>
                        <li><a href="#main" class="nav_links">Rifas</a></li>
                        <li><a href="#footer" class="nav_links">Contatos</a></li>
                        <!-- <li><a href="#" class="nav_links">Results</a></li> -->
                    </ul>
                </aside>
                <h1 class="titulo">Ganhe Grandes Prêmios!</h1>
                <p class="legenda_titulo">Compre números e tenha a chance de ganhar prêmios incríveis! ou Crie Suas próprias Rifas!</p>
                <!-- <p>Crie suas próprias rifas!</p> -->
                <div class="btn_hero">
                    <a href="#main" class="btn_nav">Comprar números</a>
                    <!-- <a class="btn_nav" href="src/view/criarRifa.php">Criar Rifa</a> -->
                    <a class="btn_nav white" href="src/view/galeria_rifas.php">Galeria de rifas</a>
                    <!-- <a class="btn_nav" href="#">View Prizes</a> -->
                    <!-- <a class="btn_nav white" href="#">Buy Tickets</a> -->
                </div>
            </li>
            <div class="card_dourado">
                <p class="legenda_hero">Sua rifa premiada!</p>
            </div>
        </section>
        <section id="diferencial">
            <h2 class="subtitulo">Por Que Nos Escolher?</h2>
            <ul id="cards_diferencial_container">
                <li class="card_diferencial">
                    <img src="assets/img/icons/facil_de_usar.png" alt="Ícone: fácil de usar" class="img_vantagens">
                    <h3>Fácil De Usar</h3>
                    <p class="legenda_diferencial">Com poucos cliques, você cria sua rifa ou compra outras rifas</p>
                </li>
                <li class="card_diferencial">
                    <img src="assets/img/icons/free.png" alt="ícone de símbolo grátis" class="img_vantagens">
                    <h3>Gratuito</h3>
                    <p class="legenda_diferencial">A plataforma não te cobra nada para criar, vender ou administrar suas rifas</p>
                </li>
                <li class="card_diferencial">
                    <img src="assets/img/icons/velocidade.png" alt="Ícone de velocidade" class="img_vantagens">
                    <h3>Velocidade</h3>
                    <p class="legenda_diferencial">A plataforma é bem otimizada, e opera muito rápida</p>
                </li>
                <li class="card_diferencial">
                    <img src="assets/img/icons/seguranca.png" alt="ícone de segurança" class="img_vantagens">
                    <h3>Segurança No Pagamento</h3>
                    <p class="legenda_diferencial">Seus pagamentos são protegidos com tecnologia de ponta!</p>
                </li>
            </ul>
        </section>
    </header>

    <main id="main">
        <h2 class="subtitulo">Rifas</h3>

            <!-- <section class="cards_rifa_container_container"> -->

            <ul class="cards_rifa_container">
                <?php foreach ($listaDasRifas as $rifa) { ?>
                    <li class="rifas" onclick="abrirRifa('<?= $rifa->getIdRifa() ?>')">
                        <?php if ($rifa->getImagemIlustrativa() != null) { ?>
                            <img src="<?= $rifa->getImagemIlustrativa() ?>" alt="img_ilustrativa" width="150px" height="90px">
                        <?php } ?>
                        <div class="rifas_infos rifas_infos_index">
                            <p class="valor_rifa"><span class="premio_rifa">Objetivo:</span> <?= $rifa->getObjetivo() ?></p>
                            <p class="premio_rifa"><?= $rifa->getPremio() ?></p>
                            <p class="valor_rifa">R$ <?= number_format($rifa->getValorCadaNumero(), 2, ',') ?></p>
                        </div>
                        <!-- <button onclick="abrirRifa(<?= $rifa->getIdRifa() ?>)">Abrir Rifa</button> -->
                    </li>
                    <div class="rifa_aberta" id="id<?= $rifa->getIdRifa() ?>">
                        <button onclick="fecharRifa(<?= $rifa->getIdRifa() ?>)" class="btn_fechar">x</button>
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
                                            <li class="numero numero_vendido" id="n<?= $i ?>r<?= $rifa->getIdRifa() ?>">
                                                <?= $i;
                                                if ($rifa->getStatusVendas() == 1) {
                                                ?>
                                                    <input type="checkbox" value="<?= $i ?>" id="i<?= $i ?>r<?= $rifa->getIdRifa() ?>" checked disabled class="numeros_rifa_vendidos">
                                                <?php } ?>
                                            </li>
                                        </label>
                                    <?php } else { ?>
                                        <label>
                                            <li class="numero numero_disponivel" id="n<?= $i ?>r<?= $rifa->getIdRifa() ?>">
                                                <?= $i;
                                                if ($rifa->getStatusVendas() == 1) {
                                                ?>
                                                    <input type="checkbox" name="numeros[]" value="<?= $i ?>" id="i<?= $i ?>r<?= $rifa->getIdRifa() ?>" class="numeros_rifa_disponiveis">
                                                <?php } ?>
                                            </li>
                                        </label>
                                <?php }
                                } ?>
                            </ul>

                            <?php if ($rifa->getStatusVendas() == 1) {  ?>

                                <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">
                                <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario() ?>">
                                <div class="container_btn_rifa">
                                    <input type="submit" value="Comprar Números" id="btn_comprar_numeros<?= $rifa->getIdRifa() ?>" class="btn_comprar_numeros btn_nav" disabled>
                                    <button type="button" class="btn_limpar_selecao btn_nav white" disabled>Limpar Seleções</button>
                                </div>
                            <?php } ?>
                        </form>
                        <?php $numerosDoUsuario = $usuario->listarNumerosDoUsuarioDaRifa($usuario->getIdUsuario(), $rifa->getIdRifa());
                        // var_dump($numerosDoUsuario);
                        if (count($numerosDoUsuario) > 0) {
                        ?>
                            <div class="lista_numeros_container">
                                <p class="label_lista_numeros">Seus números:</p>
                                <ul class="lista_numeros_usuario">
                                    <?php

                                    foreach ($numerosDoUsuario as $numero) {
                                    ?>
                                        <li class="numeros_usuario"><?= $numero->numero ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
                ?>
            </ul>

            <!-- </section> -->
    </main>

    <footer id="footer">
        <ul id="footer_content">
            <li class="li_footer">
                <h4 class="titulo_footer">Sobre LuckyDraw</h4>
                <p class="legenda_footer">LuckyDraw é uma plataforma de criação e venda de rifas, feita para facilitar a organização e a divulgação das rifas</p>
            </li>
            <li class="li_footer">
                <h4 class="titulo_footer">Contatos</h4>
                <p class="legenda_footer">Email: kaueantoniomansursantos@gmail.com</p>
            </li>
        </ul>
    </footer>


    <script src="assets/js/script.js"></script>
</body>

</html>