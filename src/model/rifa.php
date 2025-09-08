<?php

require "usuario.php";
// require "database.php";

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
    private $idUsuario;
    private $privacidade;

    public function __construct($idRifa = 0, $objetivo = 0, $quantidadeDeNumeros = 0, $premio = 0, $imagemIlustrativa = 0, $dataDoSorteio = 0, $localDoSorteio = 0, $valorCadaNumero = 0, $valorTotal = 0, $idUsuario = 0, $privacidade = 0) {
        $this->idRifa = $idRifa;
        $this->objetivo = $objetivo;
        $this->quantidadeDeNumeros = $quantidadeDeNumeros;
        $this->premio = $premio;
        $this->imagemIlustrativa = $imagemIlustrativa;
        $this->dataDoSorteio = $dataDoSorteio;
        $this->localDoSorteio = $localDoSorteio;
        $this->valorCadaNumero = $valorCadaNumero;
        $this->valorTotal = $valorTotal;
        $this->idUsuario = $idUsuario;
        $this->privacidade = $privacidade;
    }

    public function converterSqlEmObjeto(){

        $db = new Database();

        $listSql = $db->select(
            "SELECT * FROM rifas WHERE privacidade = 0"
        );

        $list = [];

        foreach($listSql as $rifa){
            $this->idRifa = $rifa->id_rifa;
            $this->objetivo = $rifa->objetivo;
            $this->quantidadeDeNumeros = $rifa->quantidade_de_numeros;
            $this->premio = $rifa->premio;
            $this->imagemIlustrativa = $rifa->imagem_ilustrativa;
            $this->dataDoSorteio = $rifa->data_do_sorteio;
            $this->localDoSorteio = $rifa->local_do_sorteio;
            $this->valorCadaNumero = $rifa->valor_cada_numero;
            $this->valorTotal = $rifa->valor_total;
            $this->idUsuario = $rifa->id_usuario;
            $this->privacidade = $rifa->privacidade;

            $list = [$this];
        }

        return $list;

        
    }

    public function criarRifa($objetivo, $quantidadeDeNumeros, $premio, $imagemIlustrativa, $dataDoSorteio, $localDoSorteio, $valorCadaNumero, $valorTotal, $idUsuario, $privacidade){
        $db = new Database();
        // $usuario = new Usuario();

        // $idUsuario = $usuario->getIdUsuario();
        // $idUsuario = 1;

        if($valorCadaNumero > 0){
            $valorTotal = $valorCadaNumero * $quantidadeDeNumeros;
        } else{
            $valorCadaNumero = $valorTotal / $quantidadeDeNumeros;
        }

        $db->insert(
            "INSERT INTO rifas(objetivo, quantidade_de_numeros, premio, imagem_ilustrativa, data_do_sorteio, local_do_sorteio, valor_cada_numero, valor_total, id_usuario, privacidade) 
            VALUES('$objetivo', '$quantidadeDeNumeros', '$premio', '$imagemIlustrativa', '$dataDoSorteio', '$localDoSorteio', $valorCadaNumero, $valorTotal, '$idUsuario', $privacidade)"
        );
    }

    public function listarTodasAsRifas($id = 0){
        $db = new Database();

        if($id != 0){
            return $db->select(
                "SELECT * FROM rifas WHERE id_usuario = $id"
            );
        } else{
            return $db->select(
                "SELECT * FROM rifas WHERE privacidade = 0"
            );
        }

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