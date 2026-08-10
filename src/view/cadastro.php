<?php
require_once "../../config.php";
require "../controller/session_on.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kauê Mansur Dev">
    <meta name="description" content="Cadastre-se para criar suas rifas ou comprar números de outras rifas existentes">
    <link rel="shortcut icon" href="../../assets/img/icons/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/responsividade.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Cadastro</title>
</head>

<body id="body_login">

    <?php if (isset($_SESSION["erro"])) { ?>
        <div class="popup_erro"><?php echo "<p class='legenda_popup'>" . $_SESSION["erro"] . "</p>"; ?></div>
    <?php
        unset($_SESSION["erro"]);
    } ?>

    <form action="../controller/cadastrar_usuario_controller.php" method="post" class="form_login">
        <h1 class="titulo txt_left">Cadastre-se</h1>
        <P class="txt_secundario" style="margin-bottom: 25px;">Crie sua conta agora</P>

        <div class="div_campo_login">
            <label for="" class="label_login login">Nome</label>
            <input type="text" name="nome" class="input_login" required>
            <div class="required_cadastro">*</div>
        </div>

        <div class="email_telefone_container">
            <div class="required_cadastro_login">*</div>
            <div class="div_campo_login">
                <label for="telefone" class="label_login login">Telefone</label>
                <input type="tel" name="telefone" id="telefone" class="input_login" autocomplete="off">
            </div>

            <div class="div_campo_login">
                <label for="" class="label_login login">Email</label>
                <input type="email" name="email" class="input_login" autocomplete="off">
            </div>
        </div>

        <div class="div_campo_login">
            <label for="" class="label_login login">Senha</label>
            <input type="password" name="senha" class="input_login" autocomplete="off" required>
            <div class="required_cadastro">*</div>
        </div>

        <div class="div_campo_login">
            <label for="" class="label_login login">Confirme sua senha</label>
            <input type="password" name="senha_confirm" class="input_login" autocomplete="off" required>
            <div class="required_cadastro">*</div>
        </div>

        <input type="submit" value="Cadastrar" class="btn_form">
        <p class="txt_secundario">Já tem conta? <a href="login.php" class="link">Faça login</a></p>
    </form>
    <script src="../../assets/js/mascaras.js"></script>
</body>

</html>