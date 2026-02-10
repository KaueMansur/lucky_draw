<?php

require "../controller/session_off.php";
require "../model/rifa.php";

$img = null;
$objetivo = null;

// if(isset($_POST["foto"])){
//     var_dump($_POST["foto"]);
// }

// if(isset($_FILES["foto"])){
    // echo "../../assets/img/uploads/".basename($_FILES["foto"]["name"]);
    // var_dump($_FILES["foto"]["tmp_name"]);
// }

if($_FILES["foto"]["name"] != "") {
    //Recebimento da foto de perfil (arquivo)
    $target_dir = "../../assets/img/uploads/";
    $file_name = basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $file_name;
    $target_database = "assets/img/uploads/".$file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
        // echo "Arquivo enviado é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "Arquivo enviado NÃO É uma imagem.";
        $uploadOk = 0;
    }

    //Verifica se o arquivo já existe
    if (file_exists($target_file)) {
        // echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

    //Verifica tamanho do arquivo
    if ($_FILES["foto"]["size"] > 2100000) {
        // echo "Arquivo muito grande! (Limite 2MB).";
        $uploadOk = 0;
    }

    // Permitir apenas alguns formatos
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Desculpe, somente aceitamos arquivos JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
    } 

    //Se cair em algum daqueles filtros, não realiza upload
    if ($uploadOk == 0) {
        // echo "Desculpe, seu arquivo não foi salvo.";
    //Senão, realiza.
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            // echo "O arquivo ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " foi salvo com sucesso!";
        } else {
            // echo "Desculpe, houve algum erro no download. Tente novamente mais tarde.";
        }
    }
} else {
    $target_database = null;
}

if (isset($_POST["objetivo"])) {
    $objetivo = $_POST["objetivo"];
}


if (isset($_POST["quantidade_numeros"])) {
    if (isset($_POST["valor_numeros"]) || isset($_POST["valor_total"]) && isset($_POST["premio"]) && isset($_POST["data_sorteio"]) && isset($_POST["local_sorteio"]) && isset($_POST["id_usuario"]) && isset($_POST["privacidade"])) {

        if(isset($_POST["valor_total"])){
            $_POST["valor_numeros"] = null;
        } else{
            $_POST["valor_total"] = null;
        }
        $rifa = new Rifa();

        $rifa->criarRifa($objetivo, $_POST["quantidade_numeros"], $_POST["premio"], $target_database, $_POST["data_sorteio"], $_POST["local_sorteio"], $_POST["valor_numeros"], $_POST["valor_total"], $_POST["id_usuario"], $_POST["privacidade"]);

        // $_SESSION["usuario"] = $_POST["usuario"];
        header("Refresh: 0; URL= ../view/galeria_rifas.php");
    }
} else {
    header("Refresh: 0; URL= ../view/criarRifa.php");
}
