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
    <link rel="stylesheet" href="../../assets/css/responsividade.css">
    <title>Galeria de Rifas</title>
</head>

<body>
    <header id="header_galeria">
        <h1 class="titulo">Galeria de rifas</h1>
        <a href="../../index.php" class="btn_voltar"><img src="../../assets/img/icons/casa_voltar.png" alt="Voltar à página inicial"></a>
    </header>

    <main id="main">
        <a class="btn_nav btn_aside" href="criarRifa.php">Criar Rifa</a>
        <h2 class="subtitulo">Suas Rifas</h2>
        <ul class="cards_rifa_container">
            <?php foreach ($listaDasRifas as $rifa) { ?>
                <li class="rifas" onclick="abrirRifa(<?= $rifa->getIdRifa() ?>)">
                    <img src="../../<?= $rifa->getImagemIlustrativa() ?>" alt="img" width="150px" height="90px">
                    <!-- <p>Número Sorteado: <?= $rifa->getNumeroSorteado() ?></p> -->
                    <article class="rifa_aberta" id="id<?= $rifa->getIdRifa() ?>">
                        <button onclick="fecharRifa('<?= $rifa->getIdRifa() ?>')" class="btn_fechar">x</button>


                        <form action="../controller/comprar_numeros_controller.php" method="post" style="display: flex; flex-direction: column; align-items: center; gap: 30px">
                            <!-- </form> -->
                            <ul class="espaco_numeros espaco_vendas">
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
                                            <li class="numero numero_vendido" id="n<?= $i ?>r<?= $rifa->getIdRifa() ?>">
                                                <?= $i ?>
                                                <input type="checkbox" value="<?= $i ?>" id="i<?= $i ?>r<?= $rifa->getIdRifa() ?>" checked disabled class="numeros_rifa_vendidos">
                                            </li>
                                        </label>

                                    <?php } else { ?>
                                        <label>
                                            <?php if ($rifa->getStatusVendas() == 1) { ?>
                                                <li class="numero numero_disponivel" id="n<?= $i ?>r<?= $rifa->getIdRifa() ?>">
                                                    <?= $i ?>
                                                    <input type="checkbox" name="numeros[]" value="<?= $i ?>" id="i<?= $i ?>r<?= $rifa->getIdRifa() ?>" class="numeros_rifa_disponiveis">
                                                </li>
                                            <?php } else { ?>
                                                <li class="numero" id="n<?= $i ?>r<?= $rifa->getIdRifa() ?>" style="cursor: default;">
                                                    <?= $i ?>
                                                    <input type="checkbox" name="numeros[]" value="<?= $i ?>" id="i<?= $i ?>r<?= $rifa->getIdRifa() ?>" class="numeros_rifa_disponiveis" disabled>
                                                </li>
                                            <?php } ?>
                                        </label>
                                <?php
                                    }
                                } ?>
                            </ul>
                            <!-- <div class="container_btn_rifa">
                                    <input type="submit" value="Comprar Números" id="btn_comprar_numeros<?= $rifa->getIdRifa() ?>" class="btn_comprar_numeros btn_nav" disabled>
                                </div> -->
                            <?php if ($rifa->getStatusVendas() == 1) { ?>
                                <button type="button" class="btn_limpar_selecao btn_nav" disabled>Limpar Seleções</button>
                            <?php } ?>

                            <section class="espaco_numeros espaco_compradores">
                                <?php if ($rifa->getStatusVendas() == 1) { ?>
                                    <img src="../../assets/img/icons/adicionar-usuario.png" onclick="criarVenda('<?= $rifa->getIdRifa() ?>')" id="btn_criar_venda<?= $rifa->getIdRifa() ?>" class="btn_add_usuario">
                                <?php } ?>
                                <ul class="card_comprados">
                                    <?php

                                    $usuarioTemporario = new UsuarioTemporario();

                                    $listaUsuarios = $usuarioTemporario->listarUsuariosDaRifa($rifa->getIdRifa());

                                    $listaUsuariosObj = [];

                                    $listaFinalNumeros = [];

                                    $usuarioFake = new UsuarioTemporario(null, null, $rifa->getIdRifa(), -1, null);

                                    array_push($listaUsuariosObj, $usuarioFake);

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

                                        <li class="card_vendas" id="card<?= $usuario->getIdUsuario() ?>">

                                            <input type="hidden" id="id_hidden<?= $usuario->getIdUsuario() ?>" value="<?= $usuario->getIdUsuario() ?>">
                                            <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">

                                            <form action="../controller/editar_usuario_temp_controller.php" method="post" class="form_container" id="editar_usuario<?= $usuario->getIdUsuario() ?>">
                                                <input type="hidden" id="id_usuario<?= $usuario->getIdUsuario() ?>" value="<?= $usuario->getIdUsuario() ?>">
                                                <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">

                                                <div class="usuario_temp_container">
                                                    <label class="label_usuario_temp">Nome:</label>
                                                    <input type="text" name="nome_usuario_temp" class="nome_usuario_temp" id="nome_usuario_temp<?= $usuario->getIdUsuario() ?>" value="<?= $usuario->getNome() ?>" disabled>
                                                </div>

                                                <div class="usuario_temp_container">
                                                    <label class="label_usuario_temp">Telefone:</label>
                                                    <input type="tel" name="tel_usuario_temp" class="infos_usuario_temp" id="telefone_usuario_temp<?= $usuario->getIdUsuario() ?>" value="<?= $usuario->getTelefone() ?>" disabled>
                                                </div>

                                                <div class="usuario_temp_container numeros_usuario_temp_container" id="lista_numeros<?= $usuario->getIdUsuario() ?>">
                                                    <label class="label_usuario_temp label_numero_usuario_temp" id="label_numeros<?= $usuario->getIdUsuario() ?>">Números:</label>
                                                    <ul class="numeros_usuario_temp_ul" id="ul_numeros_usuario_temp<?= $usuario->getIdUsuario() ?>">
                                                        <?php
                                                        $key = 1;
                                                        foreach ($usuario->getNumeros() as $n) {
                                                            if ($key == 3) {
                                                        ?>
                                                                <li class="numero_usuario_temp" style="padding: 3px; padding-inline: 10px; font-size: 18pt; cursor:pointer;" onclick="expandirNumerosVendidos(<?= $usuario->getIdUsuario() ?>)" id="btn_mostrar_numeros<?= $usuario->getIdUsuario() ?>">+</li>
                                                            <?php }
                                                            $key++; ?>
                                                            <li class="numero_usuario_temp"><?= $n ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <?php if ($rifa->getStatusVendas() == 1) { ?>
                                                    <div class="div_duplo_input" style="display: none;" id="btns_confirmar<?= $usuario->getIdUsuario() ?>">
                                                        <button type="submit" class="btns_confirm" onclick="ativarHiddens(<?= $usuario->getIdUsuario() ?>)" style="background-color: rgba(7, 148, 7, 1);">Salvar</button>
                                                        <button type="button" class="btns_confirm" style="background-color: #F00;" onclick="cancelarEdicao(<?= $usuario->getIdUsuario() ?>)">Cancelar</button>
                                                    </div>
                                                <?php } ?>
                                            </form>
                                            <?php if ($rifa->getStatusVendas() == 1) { ?>
                                                <div class="actions_usuario_temp" id="btns_padrao<?= $usuario->getIdUsuario() ?>">
                                                    <input type="submit" id="btn_comprar_numeros<?= $usuario->getIdUsuario() ?>" onclick="ativarHiddens('<?= $usuario->getIdUsuario() ?>')" class="btn_add_numeros" value="Adicionar Números" disabled>
                                                    <div class="delete_edit">
                                                        <?php
                                                        $qnt = $usuario->getQuantidadeNumeros($usuario->getIdUsuario());
                                                        if ($qnt == 0) {
                                                        ?>
                                                            <form action="../controller/excluir_usuario_temp_controller.php" method="post">
                                                                <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario() ?>">
                                                                <button class="btn_deletar"><img src="../../assets/img/icons/lixeira.png" alt="Excluir" height="20px"></button>
                                                            </form>
                                                        <?php }
                                                        ?>
                                                        <button type="button" id="btn_editar_usuario<?= $usuario->getIdUsuario() ?>" onclick="editarUsuarioTemp('<?= $usuario->getIdUsuario() ?>')" class="btn_editar_usuario_temp"><img src="../../assets/img/icons/lapis-editar.png" alt="Editar Usuário" height="20px"></button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </li>
                                    <?php }
                                    ?>
                                </ul>
                            </section>
                        </form> <!--Fechamento form compra numeros-->

                        <?php if ($rifa->getStatusVendas() == 1) { ?>
                            <form action="../controller/cadastrar_usuario_temp_controller.php" method="post" class="card_cadastro" id="card_comprador<?= $rifa->getIdRifa() ?>">

                                <div class="container_container_cadastro_temp">
                                    <div class="container_cadastro_usuarios_temp">
                                        <label class="label_cadastro_rifa">Nome:</label>
                                        <input type="text" name="nome" id="" class="input_usuario_temp">
                                    </div>

                                    <div class="container_cadastro_usuarios_temp">
                                        <label class="label_cadastro_rifa" id="label_cadastro_telefone">Telefone:</label>
                                        <input type="tel" name="telefone" id="" class="input_usuario_temp">
                                    </div>

                                </div>

                                <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">

                                <div class="div_duplo_input">
                                    <button onclick="cancelarVenda('<?= $rifa->getIdRifa() ?>')" type="button" class="btn_nav white btn_cadastro" id="btn_cancelar_venda<?= $usuario->getIdUsuario() ?>">Cancelar Venda</button>
                                    <button type="submit" class="btn_nav btn_cadastro">Cadastrar Comprador</button>
                                </div>

                            </form>

                            <form action="../controller/encerrar_vendas.php" method="post">
                                <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">
                                <input type="submit" value="Encerrar Vendas" class="btn_encerrar_venda">
                            </form>

                        <?php } elseif (!in_array($rifa->getNumeroSorteado(), $numerosConvertidos)) { ?>
                            <button onclick="mostrarOpcoesDeSorteio('<?= $rifa->getIdRifa() ?>')" class="btn_encerrar_venda" style="background-color: #F80;">Opções de sorteio</button>
                        <?php } ?>

                        <div id="opcoes_de_sorteio<?= $rifa->getIdRifa() ?>" class="desativado">
                            <button onclick="abrirSorteio('<?= $rifa->getIdRifa() ?>')">Sortear</button>
                            <button onclick="cancelarOpcoesSorteio('<?= $rifa->getIdRifa() ?>')">Cancelar</button>
                        </div>

                        <form class="popup_sorteio" id="popup_sorteio<?= $rifa->getIdRifa() ?>" method="post" action="../controller/sorteio_controller.php" class="desativado card_sorteio">
                            <div class="sorteio_container">
                                <div>
                                    <input type="checkbox" name="numeros_comprados" id="numeros_comprados<?= $rifa->getIdRifa() ?>" value="true" checked>
                                    <label for="numeros_comprados<?= $rifa->getIdRifa() ?>" class="legenda_sorteio">Somente números comprados</label>
                                </div>
                                <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">
                                <div class="div_duplo_input">
                                    <button type="button" onclick="cancelarSorteio('<?= $rifa->getIdRifa() ?>')" class="btn_nav white btn_cadastro btn_sorteio">Cancelar Sorteio</button>
                                    <button type="submit" class="btn_nav btn_cadastro btn_sorteio">Sortear</button>
                                </div>
                            </div>
                        </form>
                        <div class="infos_local_data_container" style="bottom: -10vh;">
                            <div class="infos_local_data">
                                <img src="../../assets/img/icons/calendario32.png" alt="Ícone de calendário">
                                <p><?php 
                                    $data = new DateTime($rifa->getDataDoSorteio());
                                    echo $data->format("d/m/y");
                                
                                ?></p>
                            </div>
                            <div class="infos_local_data">
                                <img src="../../assets/img/icons/local.png" alt="Ícone de local">
                                <p><?= $rifa->getLocalDoSorteio() ?></p>
                            </div>
                        </div>
                    </article>
                    <article class="rifas_infos">
                        <div class="rifas_infos_container">
                            <p class="valor_rifa"><span class="premio_rifa">Objetivo:</span> <?= $rifa->getObjetivo() ?></p>
                            <p class="premio_rifa"><?= $rifa->getPremio() ?></p>
                            <p class="valor_rifa">R$ <?= number_format($rifa->getValorCadaNumero(), 2, ',') ?></p>
                        </div>
                        <?php
                        if ($rifa->getQuantidadeNumerosVendidos($rifa->getIdRifa()) == 0) { ?>
                            <div class="data_deletar_container">
                                <form action="../controller/deletar_rifa_controller.php" method="post" class="btn_deletar_form">
                                    <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">
                                    <button class="btn_deletar"><img src="../../assets/img/icons/lixeira.png" alt="Excluir" height="20px"></button>
                                </form>
                                <div class="rifas_infos_container data_container">
                                    <img src="../../assets/img/icons/calendario.png" alt="Ícone de data">
                                    <p><?php
                                        $data = new DateTime($rifa->getDataDoSorteio());
                                        echo $data->format("d/m/y");
                                        ?></p>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="rifas_infos_container data_container">
                                <img src="../../assets/img/icons/calendario.png" alt="Ícone de data">
                                <p><?php
                                    $data = new DateTime($rifa->getDataDoSorteio());
                                    echo $data->format("d/m/y");
                                    ?></p>
                            </div>
                        <?php } ?>
                    </article>

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
            <?php } ?>
        </ul>

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

    <script src="../../assets/js/script.js"></script>
</body>

</html>