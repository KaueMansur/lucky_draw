<?php

require "../model/database.php";

if(isset($_POST["id_rifa"])){
    $db = new Database();

    $db->delete(
        "DELETE FROM rifas WHERE id_rifa = {$_POST['id_rifa']}"
    );
}

header("Refresh:0, URL= ../view/galeria_rifas.php");

?>