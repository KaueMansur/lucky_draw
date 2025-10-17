<?php

require "../controller/session_off.php";
require "../model/rifa.php";

$img = null;
$objetivo = null;

if (isset($_FILES["img_ilustrativa"])) {
    $diretorio = "../../assets/img/uploads/";
    $arquivo = $_FILES["img_ilustrativa"];

    if ($arquivo["error"] == 0) {
        $nomeArquivo = $diretorio . basename($arquivo["name"]);

        if (move_uploaded_file($arquivo["tmp_name"], $nomeArquivo)) {
            $img = addslashes(file_get_contents($arquivo["tmp_name"]));
            // var_dump($img);
            echo "O arquivo foi enviado com sucesso.";
        } else {
            echo "Erro ao mover o arquivo.";
        }
    } else {
        echo "Erro no upload do arquivo. Código de erro: " . $arquivo["error"];
    }
}

if (isset($_POST["objetivo"])) {
    $objetivo = $_POST["objetivo"];
}


if (isset($_POST["quantidade_numeros"])) {
    if (isset($_POST["valor_numeros"]) || isset($_POST["valor_total"]) && isset($_POST["premio"]) && isset($_POST["data_sorteio"]) && isset($_POST["local_sorteio"]) && isset($_POST["id_usuario"]) && isset($_POST["privacidade"])) {

        $rifa = new Rifa();

        $rifa->criarRifa($objetivo, $_POST["quantidade_numeros"], $_POST["premio"], $img, $_POST["data_sorteio"], $_POST["local_sorteio"], $_POST["valor_numeros"], $_POST["valor_total"], $_POST["id_usuario"], $_POST["privacidade"]);

        $_SESSION["usuario"] = $_POST["usuario"];
        // header("Refresh: 0; URL= ../view/galeria_rifas.php");
    }
} else {
    // header("Refresh: 0; URL= ../view/criarRifa.php");
}
