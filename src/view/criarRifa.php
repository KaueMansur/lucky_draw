<?php

require "../model/usuario.php";
require_once "../../config.php";
require "../controller/session_off.php";

$usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/icons/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/responsividade.css">
    <title>Criar Rifa</title>
</head>

<body id="body_login" style="padding: 30px;">
    <h1 class="titulo">Criar Rifa</h1>

    <form action="../controller/criar_rifa_controller.php" method="post" enctype="multipart/form-data" class="form_rifa">

        <div class="div_campo_login">
            <label for="" class="label_login">Objetivo</label>
            <input type="text" name="objetivo" id="input_objetivo" class="input_login input_objetivo" placeholder="Escreva o objetivo da rifa" maxlength="15" autocomplete="off" required>
            <span id="numero_de_letras">0/15</span>
        </div>

        <section class="div_duplo_container" id="qnt_numeros_privacidade_container">

            <div class="div_campo_login">
                <label for="" class="label_login">Quantidade de números</label>
                <input type="number" name="quantidade_numeros" class="input_login" placeholder="Ex: 100" autocomplete="off" required>
            </div>

            <div class="div_campo_login">
                <label for="" class="label_login" id="label_privacidade">Privacidade</label>
                <ul class="lista_privacidade">

                    <li>
                        <input type="radio" name="privacidade" id="publico" value="0" checked>
                        <label for="publico">Público</label>
                    </li>

                    <li>
                        <input type="radio" name="privacidade" id="privado" value="1">
                        <label for="privado">Privado</label>
                    </li>

                </ul>
            </div>
        </section>

        <section class="input_valor_container ">
            <div class="div_campo_login valor_container">
                <input type="radio" name="tipo_de_valor" id="radio_valor_numeros" class="tipo_de_valor" checked>
                <label for="valor_numeros" class="label_login label_valor" style="text-align: center;">Valor de cada número</label>
                <input type="number" name="valor_numeros" id="valor_numeros" class="input_login input_valor" placeholder="Ex: 2.00" step="0.01" autocomplete="off">
            </div>

            <div class="div_campo_login valor_container">
                <input type="radio" name="tipo_de_valor" id="radio_valor_total" class="tipo_de_valor">
                <label for="valor_total" class="label_login label_valor" style="text-align: center;">Valor total</label>
                <input type="number" name="valor_total" id="valor_total" class="input_login input_valor" disabled placeholder="Ex: 200.00" autocomplete="off">
            </div>
        </section>

        <section class="div_duplo_container">
            <div class="div_campo_login">
                <label for="premio" class="label_login">Prêmio</label>
                <input type="text" name="premio" id="premio" class="input_login" placeholder="Digite o prêmio da rifa">
            </div>

            <div class="div_campo_login campo_imagem">
                <label for="foto" class="label_login" id="label_img">Imagem ilustrativa</label>
                <input type="file" name="foto" id="foto" style="display: none;">
                <label for="foto" class="btn_carregar_imagem"><img src="../../assets/img/icons/envio.png" alt=""></label>
            </div>
        </section>

        <section class="div_duplo_container">
            <div class="div_campo_login">
                <label for="data_sorteio" class="label_login">Data do sorteio</label>
                <input type="date" name="data_sorteio" id="data_sorteio" class="input_login">
            </div>

            <div class="div_campo_login">
                <label for="local" class="label_login">Local do sorteio</label>
                <input type="text" name="local_sorteio" id="local" class="input_login" placeholder="Ex: Instagram: Meu_Instagram">
            </div>
        </section>


        <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario() ?>">

        <div class="div_duplo_input">
            <button class="btn_nav" style="width: 40%;">Criar Rifa</button>
            <button type="button" onclick="window.location.href='../view/galeria_rifas.php'" class="btn_nav white" style="width: 40%;">Cancelar</button>
        </div>

    </form>
    <script src="../../assets/js/script.js"></script>
</body>

</html>