<?php

// require "../model/usuario.php";
// require "../model/database.php";
require "../model/usuario.php";
// require "../model/usuario.php";
require "../controller/session_off.php";

$db = new Database();

// var_dump($usuario);

if(isset($_POST["numeros"])){
    var_dump($_POST["numeros"]);
}

if(isset($_POST["id_rifa"])){
    var_dump($_POST["id_rifa"]);
}

if(isset($_POST["id_usuario"])){
    var_dump($_POST["id_usuario"]);
}


if(isset($_POST["numeros"]) && isset($_POST["id_rifa"])){
    $numeros = $_POST["numeros"];
    $idRifa = $_POST["id_rifa"];

    if(isset($_POST["id_usuario"])){
        $idUsuario = $_POST["id_usuario"];
        
        var_dump($numeros);
        var_dump($idRifa);
        var_dump($idUsuario);

        foreach($numeros as $n){
            $db->insert(
                "INSERT INTO numeros_comprados(numero, id_rifa, id_usuario) VALUES($n, $idRifa, $idUsuario)"
            );
        }
        
        if(isset($_POST["pagina_retorno"])){
            header("Refresh:0, URL= ../view/galeria_rifas.php");
        } else{
            header("Refresh:0, URL= ../../index.php");
        }
    }     
}

?>