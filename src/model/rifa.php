<?php

class Rifa{

    private $idRifa;
    private $objetivo;
    private $quantidadeDeNumeros;
    private $premio;
    private $imagemIlustrativa;
    private $dataDoSorteio;
    private $localDoSorteio;
    private $valorCadaNumero;
    private $valorTotal;

    public function __construct() {
        
    }

    public function getIdRifa() {
        return $this->idRifa;
    }

    public function setIdRifa($idRifa) {
        $this->idRifa = $idRifa;
    }

    public function getObjetivo() {
        return $this->objetivo;
    }

    public function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;
    }

    public function getQuantidadeDeNumeros() {
        return $this->quantidadeDeNumeros;
    }

    public function setQuantidadeDeNumeros($quantidadeDeNumeros) {
        $this->quantidadeDeNumeros = $quantidadeDeNumeros;
    }

    public function getPremio() {
        return $this->premio;
    }

    public function setPremio($premio) {
        $this->premio = $premio;
    }

    public function getImagemIlustrativa() {
        return $this->imagemIlustrativa;
    }

    public function setImagemIlustrativa($imagemIlustrativa) {
        $this->imagemIlustrativa = $imagemIlustrativa;
    }

    public function getDataDoSorteio() {
        return $this->dataDoSorteio;
    }

    public function setDataDoSorteio($dataDoSorteio) {
        $this->dataDoSorteio = $dataDoSorteio;
    }

    public function getLocalDoSorteio() {
        return $this->localDoSorteio;
    }

    public function setLocalDoSorteio($localDoSorteio) {
        $this->localDoSorteio = $localDoSorteio;
    }

    public function getValorCadaNumero() {
        return $this->valorCadaNumero;
    }

    public function setValorCadaNumero($valorCadaNumero) {
        $this->valorCadaNumero = $valorCadaNumero;
    }

    public function getValorTotal() {
        return $this->valorTotal;
    }

    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }    
}

?>