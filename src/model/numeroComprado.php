<?php

class NumeroComprado{

    private $idNumero;
    private $numero;
    private $idRifa;

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
}

?>