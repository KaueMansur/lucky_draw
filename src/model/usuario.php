<?php

require "numeroComprado.php";

class usuario{

    private $idUsuario;
    private $nome;
    private $telefone;
    private $email;
    private $senha;
    private $idNumeros;

    public function __construct() {
        
    }

    public function getObject(){
        return $this;
    }

    public function cadastrarUsuario($nome, $telefone, $email, $senha){
        $db = new Database();

        $db->insert(
            "INSERT INTO usuarios(nome, telefone, email, senha) VALUES('$nome', '$telefone', '$email', '$senha')"
        );
    }

    public function login($emailOuTelefone, $senha){
        $db = new Database();

        $key = false;

        $listaUsuarios = $db->select(
            "SELECT * FROM usuarios"
        );

        if(strpos($emailOuTelefone, "@") !== false){
            //email
            $this->email = $emailOuTelefone;
        } else{
            //telefone
            $this->telefone = $emailOuTelefone;
        }

        $this->senha = $senha;

        foreach($listaUsuarios as $usuario){
            if($usuario->email == $this->email){
                if($usuario->senha == $this->senha){
                    $this->idUsuario = $usuario->id_usuario;
                    $this->nome = $usuario->nome;
                    $this->telefone = $usuario->telefone;
                    $this->idNumeros = $usuario->id_numeros;

                    $key = true;
                }
            } else{
                if($usuario->telefone == $this->telefone){
                    if($usuario->senha == $this->senha){
                        $this->idUsuario = $usuario->id_usuario;
                        $this->nome = $usuario->nome;
                        $this->email = $usuario->email;
                        $this->idNumeros = $usuario->id_numeros;

                        $key = true;
                    }
                }
            }
        }

        return $key;
        
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