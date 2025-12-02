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
    private $numeroSorteado;
    private $statusVendas;

    public function __construct($idRifa = 0, $objetivo = null, $quantidadeDeNumeros = 0, $premio = null, $imagemIlustrativa = null, $dataDoSorteio = null, $localDoSorteio = null, $valorCadaNumero = 0, $valorTotal = 0, $idUsuario = 0, $privacidade = 0, $numeroSorteado = 0, $statusVendas = 0) {
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
        $this->numeroSorteado = $numeroSorteado;
        $this->statusVendas = $statusVendas;
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
            $this->quantidadeDeNumeros = $rifa->quantidade_numeros;
            $this->premio = $rifa->premio;
            $this->imagemIlustrativa = $rifa->imagem_ilustrativa;
            $this->dataDoSorteio = $rifa->data_sorteio;
            $this->localDoSorteio = $rifa->local_sorteio;
            $this->valorCadaNumero = $rifa->valor_cada_numero;
            $this->valorTotal = $rifa->valor_total;
            $this->idUsuario = $rifa->id_usuario;
            $this->privacidade = $rifa->privacidade;
            $this->numeroSorteado = $rifa->numero_sorteado;

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
            "INSERT INTO rifas(objetivo, quantidade_numeros, premio, imagem_ilustrativa, data_sorteio, local_sorteio, valor_cada_numero, valor_total, id_usuario, privacidade) 
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

    public function sortearNumero($idRifa, $somenteNumerosComprados){
        $db = new Database();

        $numerosParaSortear = [];

        if($somenteNumerosComprados){
            $numerosParaSortear = $db->select(
                "SELECT numero FROM numeros_comprados WHERE id_rifa = $idRifa"
            );

            $chaveSorteada = array_rand($numerosParaSortear, 1);

            // var_dump($numerosParaSortear[0]->numero);

            $numeroSorteado = $numerosParaSortear[$chaveSorteada]->numero;

        } else{
            $tamRifa = $db->select(
                "SELECT quantidade_numeros FROM rifas WHERE id_rifa = $idRifa"
            );

            // var_dump($tamRifa[0]->quantidade_numeros);

            $numeroSorteado = rand(1, $tamRifa[0]->quantidade_numeros);
        }

        // var_dump($numeroSorteado);

            $db->update(
                "UPDATE rifas SET numero_sorteado = $numeroSorteado WHERE id_rifa = $idRifa"
            );

    }

    public function converterIdEmRifa($idRifa){
        $db = new Database();

        return $db->select(
            "SELECT * FROM rifas WHERE id_rifa = $idRifa"
        );
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

    public function getNumeroSorteado(){
        return $this->numeroSorteado;
    }

    public function setNumeroSorteado($numero){
        $this->numeroSorteado = $numero;
    }

    public function getStatusVendas(){
        return $this->statusVendas;
    }

    public function setStatusVendas($status){
        $this->statusVendas = $status;
    }

    public function getQuantidadeNumerosVendidos($idRifa){
        $db = new Database();

        $qntNumeros = $db->select(
            "SELECT COUNT(*) FROM numeros_comprados WHERE id_rifa = $idRifa"
        );

        return $qntNumeros[0]->{'COUNT(*)'};
    }
}

?>