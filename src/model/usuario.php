<?php

class usuario{

    private $idUsuario;
    private $nome;
    private $telefone;
    private $email;
    private $senha;
    private $idNumeros;

    public function __construct() {
        
    }

    public function cadastrarUsuario(){

    }

    public function login(){

    }

    public function comprarRifa($idNumero){
        
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($id){
        $this->idUsuario = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    } 

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getIdNumeros(){
        return $this->idNumeros;
    }

    public function setIdNumeros($id){
        $this->idNumeros = $id;
    }
}

?>