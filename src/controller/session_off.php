<?php

session_start();

if(!isset($_SESSION["usuario"])){
    header("Refresh: 0; URL = ../../pg2.php");
}

?>