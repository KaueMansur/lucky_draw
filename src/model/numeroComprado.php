<?php

require "database.php";

class NumeroComprado{

    private $idNumero;
    private $numero;
    private $idRifa;
    private $idUsuario;

    public function __construct() {
        
    }

    public function getIdNumero(){
        return $this->idNumero;
    }

    public function setIdNumero($id){
        $this->idNumero = $id;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function setNumero($numero){
        $this->numero = $numero;
    }

    public function getIdRifa(){
        return $this->idRifa;
    }

    public function setIdRifa($id){
        $this->idRifa = $id;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($id){
        $this->idUsuario = $id;
    }

    public function listarTodosOsNumerosDaRifa($idRifa){
        $db = new Database();

        return $db->select(
            "SELECT quantidade_de_numeros FROM rifas WHERE id_rifa = $idRifa"
        );
    }

    public function listarNumerosCompradosDaRifa($idRifa){
        $db = new Database();
        
        return $db->select(
            "SELECT numero FROM numeros_comprados WHERE id_rifa = $idRifa"
        );

    }

}

?>