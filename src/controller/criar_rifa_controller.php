<?php

require "../controller/session_off.php";
require "../model/rifa.php";

if(isset($_POST["quantidade_numeros"])){
    if(isset($_POST["valor_numeros"]) || isset($_POST["valor_total"]) && isset($_POST["premio"]) && isset($_POST["data_sorteio"]) && isset($_POST["local_sorteio"]) && isset($_POST["id_usuario"])){
        
        $rifa = new Rifa();
        
        $rifa->criarRifa($_POST["objetivo"], $_POST["quantidade_numeros"], $_POST["premio"], $_POST["img_ilustrativa"], $_POST["data_sorteio"], $_POST["local_sorteio"], $_POST["valor_numeros"], $_POST["valor_total"], $_POST["id_usuario"], $_POST["privacidade"]);
            
        $_SESSION["usuario"] = $_POST["usuario"];
        header("Refresh: 0; URL= ../view/galeria_rifas.php");
    }
} else{
    header("Refresh: 0; URL= ../view/criarRifa.php");
}


?>