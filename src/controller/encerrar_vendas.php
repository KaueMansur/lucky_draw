<?php

require_once "../../config.php";

require "../model/database.php";

if(isset($_POST["id_rifa"])){
    $idRifa = $_POST["id_rifa"];
    $db = new Database();

    $db->update(
        "UPDATE rifas SET status_vendas = 0 WHERE id_rifa = $idRifa"
    );

    header("Refresh:0, URL= ../view/galeria_rifas.php");
}

?>