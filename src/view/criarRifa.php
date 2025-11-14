<?php

require "../model/usuario.php";

require "../controller/session_off.php";

$usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Criar Rifa</title>
</head>

<body id="body_login" style="padding: 30px;">
    <h1 class="titulo">Criar Rifa</h1>

    <form action="../controller/criar_rifa_controller.php" method="post" enctype="multipart/form-data" class="form_login" style="width: 50vw; gap: 35px">

        <div class="div_campo_login">
            <label for="" class="label_login">Objetivo</label>
            <input type="text" name="objetivo" id="" class="input_login" placeholder="Escreva o objetivo da rifa">
        </div>

        <section class="div_duplo_input">

            <div class="div_campo_login">
                <label for="" class="label_login">Quantidade de números</label>
                <input type="number" name="quantidade_numeros" id="" class="input_login" placeholder="Ex: 100">
            </div>

            <div class="div_campo_login">
                <label for="" class="label_login">Privacidade</label>
                <ul class="lista_privacidade">

                    <li>
                        <input type="radio" name="privacidade" id="" value="0" checked>
                        <label for="">Público</label>
                    </li>

                    <li>
                        <input type="radio" name="privacidade" id="" value="1">
                        <label for="">Privado</label>
                    </li>

                    <li>
                        <input type="radio" name="privacidade" id="" value="2">
                        <label for="">Somente com link</label>
                    </li>

                </ul>
            </div>
        </section>

        <section class="input_valor_container">
            <div class="div_campo_login">
                <label class="btn_radio" for="radio_valor_numeros">Usar este</label>
                <input type="radio" name="tipo_de_valor" id="radio_valor_numeros" class="tipo_de_valor" checked>
                <label for="" class="label_login" style="text-align: center;">Valor de cada número</label>
                <input type="number" name="valor_numeros" id="valor_numeros" class="input_login" placeholder="Ex: 2.00">
            </div>

            <div class="div_campo_login">
                <label class="btn_radio" for="radio_valor_total">Usar este</label>
                <input type="radio" name="tipo_de_valor" id="radio_valor_total" class="tipo_de_valor">
                <label for="" class="label_login" style="text-align: center;">Valor total</label>
                <input type="number" name="valor_total" id="valor_total" class="input_login" disabled placeholder="Ex: 200.00">
            </div>
        </section>

        <section class="div_duplo_input">
            <div class="div_campo_login">
                <label for="" class="label_login">Prêmio</label>
                <input type="text" name="premio" id="" class="input_login" placeholder="Digite o prêmio da rifa">
            </div>
    
            <div class="div_campo_login">
                <label for="" class="label_login">Imagem ilustrativa</label>
                <input type="file" name="foto" id="foto" style="display: none;">
                <label for="foto" class="btn_carregar_imagem">Carregar Imagem</label>
            </div>
        </section>

        <section class="div_duplo_input">
            <div class="div_campo_login">
                <label for="" class="label_login">Data do sorteio</label>
                <input type="date" name="data_sorteio" id="" class="input_login">
            </div>
    
            <div class="div_campo_login">
                <label for="" class="label_login">Local do sorteio</label>
                <input type="text" name="local_sorteio" id="" class="input_login" placeholder="Ex: Instagram: Meu_Instagram">
            </div>
        </section>


        <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario() ?>">

        <div class="div_duplo_input">
            <input type="submit" value="Criar Rifa" class="btn_nav">
            <a href="../view/galeria_rifas.php" class="btn_nav white" style="width: 300px; text-align:center">Cancelar</a>
        </div>

    </form>
    <script src="../../assets/js/script.js"></script>
</body>

</html>