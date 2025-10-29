<?php


require "../model/rifa.php";

require "../controller/session_off.php";

$rifa = new Rifa();

$usuario = $_SESSION["usuario"];

$numeroComprado = new NumeroComprado();

$listaDeRifas = $rifa->listarTodasAsRifas($usuario->getIdUsuario());

$listaDasRifas = [];

foreach ($listaDeRifas as $r) {
    array_push($listaDasRifas, $rifa = new Rifa($r->id_rifa, $r->objetivo, $r->quantidade_numeros, $r->premio, $r->imagem_ilustrativa, $r->data_sorteio, $r->local_sorteio, $r->valor_cada_numero, $r->valor_total, $r->id_usuario, $r->privacidade, $r->numero_sorteado, $r->status_vendas));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        #card_comprador {
            background-color: #fff;
            width: 80%;
            height: 100px;
            border: 2px solid #000;
        }

        .card_comprados {
            background-color: #fff;
            width: 50%;
            display: flex;
            flex-direction: column;
        }
    </style>
    <title>Galeria de Rifas</title>
</head>

<body>
    <header id="header_galeria">
        <h1 class="titulo">Galeria de rifas</h1>
        <a href="../../index.php" class="btn_voltar"><img src="../../assets/img/icons/casa_voltar.png" alt="Voltar à página inicial"></a>
    </header>

    <main id="main">
        <h2 class="subtitulo">Suas Rifas</h2>
        <section>
            <ul class="cards_rifa_container">
                <?php foreach ($listaDasRifas as $rifa) { ?>
                    <li class="rifas" onclick="abrirRifa(<?= $rifa->getIdRifa() ?>)">
                        <img src="../../<?= $rifa->getImagemIlustrativa() ?>" alt="img" width="100px">
                        <!-- <p>Número Sorteado: <?= $rifa->getNumeroSorteado() ?></p> -->
                        <div class="rifas_infos">
                            <!-- <p><?= $rifa->getObjetivo() ?></p> -->
                            <p class="premio_rifa"><?= $rifa->getPremio() ?></p>
                            <p class="valor_rifa"><?= number_format($rifa->getValorCadaNumero(), 2, '.') ?></p>
                        </div>

                        <?php
                        $numerosDaRifa = $numeroComprado->listarNumerosCompradosDaRifa($rifa->getIdRifa());
                        if (!count($numerosDaRifa) > 0) {
                        ?>

                            <!-- <form action="../controller/deletar_rifa_controller.php" method="post" onsubmit="confirm('Tem certeza de que deseja excluir esta Rifa?')">
                            <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">
                            <input type="submit" value="Excluir Rifa">
                        </form> -->
                        <?php } ?>
                    </li>
                    <div class="rifa_aberta" id="id<?= $rifa->getIdRifa() ?>">
                        <button onclick="fecharRifa(<?= $rifa->getIdRifa() ?>)">Fechar Rifa</button>


                        <form action="../controller/comprar_numeros_controller.php" method="post">

                            <ul class="espaco_numeros">
                                <?php

                                $numerosDaRifa = $numeroComprado->listarNumerosCompradosDaRifa($rifa->getIdRifa());

                                $numerosConvertidos = [];


                                for ($i = 0; $i < count($numerosDaRifa); $i++) {
                                    array_push($numerosConvertidos, $numerosDaRifa[$i]->numero);
                                }

                                for ($i = 1; $i < $rifa->getQuantidadeDeNumeros() + 1; $i++) {
                                    if (in_array($i, $numerosConvertidos)) {
                                        //Número vendido
                                ?>
                                        <label>
                                            <li class="numero numero_vendido">
                                                <?= $i ?>
                                                <input type="checkbox" value="<?= $i  ?>" class="criar_venda_checkbox vendido desativado" checked disabled>
                                            </li>
                                        </label>

                                    <?php } else { ?>
                                        <label>
                                            <li class="numero">
                                                <?= $i ?>
                                                <input type="checkbox" name="numeros[]" value="<?= $i  ?>" class="criar_venda_checkbox desativado">
                                            </li>
                                        </label>
                                <?php
                                    }
                                } ?>
                            </ul>

                            <section class="espaco_numeros">
                                <div class="card_comprados">
                                    <?php

                                    // $numerosPrivados = $numeroComprado->listarNumerosprivados($rifa->getIdRifa());
                                    $usuarioTemporario = new UsuarioTemporario();

                                    $listaUsuarios = $usuarioTemporario->listarUsuariosDaRifa($rifa->getIdRifa());

                                    $listaUsuariosObj = [];

                                    $listaFinalNumeros = [];

                                    foreach ($listaUsuarios as $u) {

                                        $listaDeNumeros = $usuarioTemporario->listarNumerosDoUsuario($u->id_usuario);

                                        foreach ($listaDeNumeros as $numero) {
                                            array_push($listaFinalNumeros, $numero->numero);
                                        }

                                        $usuarioTemporario = new UsuarioTemporario($u->nome, $u->telefone, $u->id_rifa, $u->id_usuario, $listaFinalNumeros);
                                        array_push($listaUsuariosObj, $usuarioTemporario);
                                        $listaFinalNumeros = [];
                                    }

                                    foreach ($listaUsuariosObj as $usuario) {
                                    ?>
                                        <!-- <form action="../controller/comprar_numeros_controller.php" method="post"> -->
                                        <input type="hidden" id="id_hidden<?= $usuario->getIdUsuario() ?>" value="<?= $usuario->getIdUsuario() ?>">
                                        <label for="">Id: <?= $usuario->getIdUsuario() ?></label>
                                        <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">
                                        <label>Nome: <?= $usuario->getNome() ?></label>
                                        <label>Telefone: <?= $usuario->getTelefone() ?></label>

                                        <label>Números:</label>
                                        <ul style="display: flex; list-style-type: none;">
                                            <?php foreach ($usuario->getNumeros() as $n) {  ?>
                                                <li><?= $n ?>, </li>
                                            <?php } ?>
                                        </ul>

                                        <?php if ($rifa->getStatusVendas() == 1) { ?>
                                            <button onclick="adicionarNumeros('<?= $usuario->getIdUsuario() ?>')" id="btn_adicionar_numeros<?= $usuario->getIdUsuario() ?>" type="button">Adicionar números</button>
                                            <input type="submit" id="btn_comprar_numeros<?= $usuario->getIdUsuario() ?>" onclick="ativarHiddens('<?= $usuario->getIdUsuario() ?>')" class="desativado" value="Próximo">
                                            <button onclick="cancelarNumeros('<?= $usuario->getIdUsuario() ?>')" id="btn_cancelar_numeros<?= $usuario->getIdUsuario() ?>" class="desativado" type="button">Cancelar</button>
                                            <!-- </form> -->

                                    <?php }
                                    } ?>
                                </div>
                            </section>
                        </form>

                        <?php if ($rifa->getStatusVendas() == 1) { ?>
                            <button onclick="criarVenda('<?= $rifa->getIdRifa() ?>')" type="button" id="btn_criar_venda<?= $rifa->getIdRifa() ?>">Criar Venda</button>
                            <button onclick="cancelarVenda('<?= $rifa->getIdRifa() ?>')" type="button" class="desativado" id="btn_cancelar_venda<?= $rifa->getIdRifa() ?>">Cancelar Venda</button>
                            <form action="../controller/cadastrar_usuario_controller.php" method="post">
                                <div id="card_comprador<?= $rifa->getIdRifa() ?>" class="desativado">

                                    <div>
                                        <label>Nome:</label>
                                        <input type="text" name="nome" id="">
                                    </div>

                                    <div>
                                        <label>Telefone:</label>
                                        <input type="tel" name="telefone" id="">
                                    </div>

                                    <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">

                                    <input type="submit" value="Cadastrar comprador">
                                </div>
                            </form>

                            <form action="../controller/encerrar_vendas.php" method="post">
                                <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">
                                <input type="submit" value="Encerrar Vendas">
                            </form>

                        <?php } elseif (!in_array($rifa->getNumeroSorteado(), $numerosConvertidos)) { ?>
                            <button onclick="mostrarOpcoesDeSorteio('<?= $rifa->getIdRifa() ?>')">Opções de sorteio</button>
                        <?php } ?>

                        <div id="opcoes_de_sorteio<?= $rifa->getIdRifa() ?>" class="desativado">
                            <button onclick="abrirSorteio('<?= $rifa->getIdRifa() ?>')">Sortear</button>
                            <button onclick="cancelarOpcoesSorteio('<?= $rifa->getIdRifa() ?>')">Cancelar</button>
                        </div>

                        <form id="popup_sorteio<?= $rifa->getIdRifa() ?>" method="post" action="../controller/sorteio_controller.php" class="desativado">
                            <input type="checkbox" name="numeros_comprados" id="numeros_comprados<?= $rifa->getIdRifa() ?>" value="true" checked>
                            <label for="numeros_comprados<?= $rifa->getIdRifa() ?>">Somente números comprados</label>
                            <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">
                            <button type="button" onclick="cancelarSorteio('<?= $rifa->getIdRifa() ?>')">Cancelar Sorteio</button>
                            <input type="submit" value="Sortear">
                        </form>
                    </div>
                <?php } ?>
            </ul>

        </section>
    </main>
    <footer id="footer">
        <div id="footer_content">
            <article class="article_footer">
                <h4 class="titulo_footer">About LuckyDraw</h4>
                <p>Lorem ipsum dolor sit amet.</p>
            </article>
            <article class="article_footer">
                <h4 class="titulo_footer">About LuckyDraw</h4>
                <p>Lorem ipsum dolor sit amet.</p>
            </article>
            <article class="article_footer">
                <h4 class="titulo_footer">About LuckyDraw</h4>
                <p>Lorem ipsum dolor sit amet.</p>
            </article>
            <article class="article_footer">
                <h4 class="titulo_footer">About LuckyDraw</h4>
                <p>Lorem ipsum dolor sit amet.</p>
            </article>
        </div>
    </footer>
    <script src="../../assets/js/script.js"></script>
</body>

</html>