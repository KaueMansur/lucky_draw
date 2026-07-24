<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["usuario"])){
    header("Refresh: 0; URL = ../../index.php");
}

?>