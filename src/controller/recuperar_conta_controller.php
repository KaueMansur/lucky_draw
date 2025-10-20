<?php

if(isset($_POST["email"])){
    $para = $_POST["email"];
} else{
    $para = null;
}

$assunto = "Assunto do email";
$mensagem = "Conteúdo da mensagem. Teste!";
$headers = "From: seuemail@example.com";

if (mail($para, $assunto, $mensagem, $headers)) {
    echo "Email enviado com sucesso!";
} else {
    echo "Falha ao enviar email.";
}

?>