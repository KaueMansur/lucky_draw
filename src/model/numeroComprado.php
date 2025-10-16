<?php

require "usuarioTemporario.php";

class NumeroComprado{

    private $idNumero;
    private $numero;
    private $idRifa;
    private $idUsuario;
    private $nomeUsuario;
    private $telefoneUsuario;

    public function __construct($idNumero = 0, $numero = 0, $idRifa = 0, $idUsuario = 0, $nomeUsuario = 0, $telefoneUsuario = 0) {
        $this->idNumero = $idNumero;
        $this->numero = $numero;
        $this->idRifa = $idRifa;
        $this->idUsuario = $idUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->telefoneUsuario = $telefoneUsuario;
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

    public function getNomeUsuario(){
        return $this->nomeUsuario;
    }

    public function setNomeUsuario($nome){
        $this->nomeUsuario = $nome;
    }

    public function getTelefoneUsuario(){
        return $this->telefoneUsuario;
    }

    public function setTelefoneUsuario($telefone){
        $this->telefoneUsuario = $telefone;
    }

    public function listarTodosOsNumerosDaRifa($idRifa){
        $db = new Database();

        return $db->select(
            "SELECT quantidade_numeros FROM rifas WHERE id_rifa = $idRifa"
        );
    }

    public function listarNumerosCompradosDaRifa($idRifa){
        $db = new Database();
        
        return $db->select(
            "SELECT numero FROM numeros_comprados WHERE id_rifa = $idRifa"
        );

    }

    public function listarNumerosprivados($idRifa){
        $db = new Database();

        return $db->select(
            "SELECT * FROM numeros_comprados WHERE id_rifa = $idRifa AND id_usuario IS NULL"
        );
    }

    public function countUsuarioRepetido($nomeUsuario){
        $db = new Database();

        return $db->select(
            "SELECT COUNT(*) FROM numeros_comprados WHERE nome_usuario = '$nomeUsuario' "
        );
    }

}

?>