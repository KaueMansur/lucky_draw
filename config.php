<?php
// config.php

// 1. Configura e inicia a sessão APENAS se ela ainda não estiver rodando
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 86400, // 24 horas em segundos
        'path' => '/',
        'domain' => '',
        'secure' => false,  // Mude para true apenas em produção com HTTPS
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

// 2. Validação extra de segurança do Navegador (User Agent)
if (!isset($_SESSION['user_agent'])) {
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
} else {
    if ($_SESSION['user_agent'] !== ($_SERVER['HTTP_USER_AGENT'] ?? '')) {
        session_unset();
        session_destroy();
        header("Location: /view/login.php");
        exit;
    }
}