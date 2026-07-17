<?php
// config.php

// 1. Configura a segurança dos cookies de sessão
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true, // Certifique-se de que seu ambiente tem HTTPS ativo!
    'httponly' => true,
    'samesite' => 'Strict'
]);

// 2. Inicia a sessão com as configurações acima aplicadas
session_start();

// 3. Validação extra de segurança do Navegador (User Agent)
if (!isset($_SESSION['user_agent'])) {
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
} else {
    if ($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_unset();
        session_destroy();
        header("Location: /view/login.php");
        exit;
    }
}