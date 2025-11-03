<?php
require "../model/rifa.php";
require "../controller/session_off.php";
// require "../model/numeroComprado.php"; // Adicionado require que estava faltando
// require "../model/usuarioTemporario.php"; // Adicionado require que estava faltando

$rifaModel = new Rifa(); // Renomeado para evitar conflito de nome com a variável $rifa dentro do loop
$usuarioModel = new UsuarioTemporario(); // Renomeado para evitar conflito de nome
$numeroCompradoModel = new NumeroComprado(); // Renomeado para evitar conflito de nome

$usuario = $_SESSION["usuario"];
$listaDeRifas = $rifaModel->listarTodasAsRifas($usuario->getIdUsuario());
$listaDasRifas = [];

foreach ($listaDeRifas as $r) {
    array_push($listaDasRifas, new Rifa($r->id_rifa, $r->objetivo, $r->quantidade_numeros, $r->premio, $r->imagem_ilustrativa, $r->data_sorteio, $r->local_sorteio, $r->valor_cada_numero, $r->valor_total, $r->id_usuario, $r->privacidade, $r->numero_sorteado, $r->status_vendas));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
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
                    <!-- Todo o conteúdo da rifa agora está DENTRO deste LI -->
                    <li class="rifas">

                        <!-- Div Clicável para abrir o detalhe -->
                        <div class="rifa_header" onclick="abrirRifa(<?= $rifa->getIdRifa() ?>)">
                            <img src="../../<?= $rifa->getImagemIlustrativa() ?>" alt="img" width="100px">
                            <p>Número Sorteado: <?= $rifa->getNumeroSorteado() ?></p>
                            <div class="rifas_infos">
                                <p class="premio_rifa"><?= $rifa->getPremio() ?></p>
                                <p class="valor_rifa"><?= number_format($rifa->getValorCadaNumero(), 2, '.') ?></p>
                            </div>

                            <?php
                            $numerosDaRifa = $numeroCompradoModel->listarNumerosCompradosDaRifa($rifa->getIdRifa());
                            if (!count($numerosDaRifa) > 0) {
                                // Aqui ficava o formulário de exclusão opcional
                            }
                            ?>
                        </div>

                        <!-- DIV DE DETALHES DA RIFA (que estava na linha 171 do seu original) -->
                        <div class="rifa_aberta" id="id<?= $rifa->getIdRifa() ?>" style="overflow: scroll;">
                            <button onclick="fecharRifa(<?= $rifa->getIdRifa() ?>)" class="btn_fechar">x</button>

                            <form action="../controller/comprar_numeros_controller.php" method="post">

                                <ul class="espaco_numeros">
                                    <?php
                                    $numerosDaRifa = $numeroCompradoModel->listarNumerosCompradosDaRifa($rifa->getIdRifa());
                                    $numerosConvertidos = [];

                                    for ($i = 0; $i < count($numerosDaRifa); $i++) {
                                        array_push($numerosConvertidos, $numerosDaRifa[$i]->numero);
                                    }

                                    for ($i = 1; $i < $rifa->getQuantidadeDeNumeros() + 1; $i++) {
                                        $id_unico_numero = $i . 'r' . $rifa->getIdRifa();
                                        if (in_array($i, $numerosConvertidos)) {
                                    ?>
                                            <label>
                                                <li class="numero numero_vendido" id="n<?= $id_unico_numero ?>">
                                                    <?= $i ?>
                                                    <input type="checkbox" value="<?= $i ?>" id="i<?= $id_unico_numero ?>" checked disabled class="numeros_rifa_vendidos">
                                                </li>
                                            </label>
                                        <?php } else { ?>
                                            <label>
                                                <li class="numero numero_disponivel" id="n<?= $id_unico_numero ?>">
                                                    <?= $i ?>
                                                    <input type="checkbox" name="numeros[]" value="<?= $i ?>" id="i<?= $id_unico_numero ?>" class="numeros_rifa_disponiveis">
                                                </li>
                                            </label>
                                    <?php
                                        }
                                    } ?>
                                </ul>
                                <!-- ... Div container_btn_rifa (comentada) ... -->


                                <section class="espaco_numeros">
                                    <ul class="card_comprados">
                                        <?php
                                        $listaUsuarios = $usuarioModel->listarUsuariosDaRifa($rifa->getIdRifa());
                                        $listaUsuariosObj = [];
                                        $listaFinalNumeros = [];

                                        foreach ($listaUsuarios as $u) {
                                            $listaDeNumeros = $usuarioModel->listarNumerosDoUsuario($u->id_usuario);
                                            foreach ($listaDeNumeros as $numero) {
                                                array_push($listaFinalNumeros, $numero->numero);
                                            }
                                            array_push($listaUsuariosObj, new UsuarioTemporario($u->nome, $u->telefone, $u->id_rifa, $u->id_usuario, $listaFinalNumeros));
                                            $listaFinalNumeros = [];
                                        }

                                        foreach ($listaUsuariosObj as $usuario) {
                                            // ID Único combinado para o usuário/rifa
                                            $id_unico_usuario_rifa = $rifa->getIdRifa() . '_' . $usuario->getIdUsuario();
                                        ?>
                                            <li class="card_vendas">

                                                <!-- Hiddens fora do form principal, mas dentro do LI de usuário -->
                                                <input type="hidden" id="id_hidden<?= $id_unico_usuario_rifa ?>" value="<?= $usuario->getIdUsuario() ?>">
                                                <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">

                                                <form action="../controller/editar_usuario_temp_controller.php" method="post" class="form_container">
                                                    <!-- Hiddens dentro do form de edição -->
                                                    <input type="hidden" id="id_hidden_form<?= $id_unico_usuario_rifa ?>" value="<?= $usuario->getIdUsuario() ?>">
                                                    <input type="hidden" name="id_rifa" value="<?= $rifa->getIdRifa() ?>">

                                                    <div class="usuario_temp_container">
                                                        <label class="label_usuario_temp">Nome:</label>
                                                        <input type="text" name="nome_usuario_temp" class="nome_usuario_temp" id="nome_usuario_temp<?= $id_unico_usuario_rifa ?>" value="<?= $usuario->getNome() ?>" disabled>
                                                    </div>

                                                    <div class="usuario_temp_container">
                                                        <label class="label_usuario_temp">Telefone:</label>
                                                        <input type="tel" name="tel_usuario_temp" class="infos_usuario_temp" id="telefone_usuario_temp<?= $id_unico_usuario_rifa ?>" value="<?= $usuario->getTelefone() ?>" disabled>
                                                    </div>

                                                    <div class="usuario_temp_container numeros_usuario_temp_container">
                                                        <label class="label_usuario_temp label_numero_usuario_temp">Números:</label>
                                                        <ul class="numeros_usuario_temp_ul">
                                                            <?php foreach ($usuario->getNumeros() as $n) {  ?>
                                                                <li class="numero_usuario_temp"><?= $n ?></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>

                                                    <!-- Bloco de botões de Confirmar/Salvar -->
                                                    <!-- Use o IF/ELSE aqui para garantir que todas as tags fechem corretamente -->
                                                    <?php if ($rifa->getStatusVendas() == 1) { ?>
                                                        <div class="div_duplo_input" style="display: none;" id="btns_confirmar<?= $id_unico_usuario_rifa ?>">
                                                            <button type="submit" class="btns_confirm" onclick="ativarHiddens(<?= $usuario->getIdUsuario() ?>)" style="background-color: rgba(7, 148, 7, 1);">Salvar</button>
                                                            <button type="button" class="btns_confirm" style="background-color: #F00;" onclick="cancelarEdicao(<?= $rifa->getIdRifa() . $usuario->getIdUsuario() ?>)">Cancelar</button>
                                                        </div>
                                                    <?php } ?>

                                                </form> <!-- FECHAMENTO DO FORM DE EDIÇÃO -->

                                                <!-- Bloco de botões Padrão (fora do form, mas dentro do LI) -->
                                                <?php if ($rifa->getStatusVendas() == 1) { ?>
                                                    <div class="div_duplo_input" id="btns_padrao<?= $id_unico_usuario_rifa ?>">
                                                        <input type="submit" id="btn_comprar_numeros<?= $id_unico_usuario_rifa ?>" onclick="ativarHiddens('<?= $usuario->getIdUsuario() ?>')" class="btn_add_numeros" value="Adicionar Números" disabled>
                                                        <button type="button" id="btn_editar_usuario<?= $id_unico_usuario_rifa ?>" onclick="editarUsuarioTemp('<?= $rifa->getIdRifa() . $usuario->getIdUsuario() ?>')" class="btn_editar_usuario_temp"><img src="../../assets/img/icons/lapis-editar.png" alt="Editar Usuário" height="25px"></button>
                                                    </div>
                                                <?php } ?>
                                            </li> <!-- FIM do LI card_vendas -->
                                        <?php } // Fim do foreach ($listaUsuariosObj as $usuario) 
                                        ?>
                                    </ul>
                                </section>
                            </form> <!-- Fechamento do form de compra de números -->
                        </div> <!-- FIM DA DIV rifa_aberta -->
                    </li> <!-- FIM DO LI rifas -->
                <?php } // Fim do foreach ($listaDasRifas as $rifa) 
                ?>
            </ul>
        </section>
    </main>
    <!-- Inclua seus scripts JS aqui -->
    <script src="../../assets/js/script.js"></script>
</body>

</html>