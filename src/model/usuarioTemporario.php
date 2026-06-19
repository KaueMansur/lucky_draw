<?php
require "database.php";

class UsuarioTemporario
{
    private $idUsuario;
    private $nome;
    private $telefone;
    private $idRifa;
    private $numeros;

    public function __construct($nome = 0, $telefone = 0, $idRifa = 0, $idUsuario = 0, $numeros = [])
    {
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->idRifa = $idRifa;
        $this->idUsuario = $idUsuario;
        $this->numeros = $numeros;
    }

    public function listarUsuariosDaRifa($idRifa)
    {
        $db = new Database();

        return $db->select(
            "SELECT * FROM usuarios_temp WHERE id_rifa = $idRifa"
        );
    }

    public function contarUsuariosDaRifa($idRifa)
    {
        $db = new Database();

        return $db->select(
            "SELECT COUNT(*) FROM usuarios_temp WHERE id_rifa = $idRifa"
        );
    }

    public function listarNumerosDoUsuario($idUsuario)
    {
        $db = new Database();

        return $db->select(
            "SELECT numero FROM numeros_comprados WHERE id_usuarios_temp = $idUsuario"
        );
    }

    public function cadastrarUsuarioTemporario($nome, $telefone, $idRifa)
    {
        $db = new Database();

        $db->insert(
            "INSERT INTO usuarios_temp(nome, telefone, id_rifa) VALUES('$nome', '$telefone', '$idRifa')"
        );
    }

    public function editarUsuarioTemporario($idUsuario, $novoNome, $novoTelefone)
    {
        $db = new Database();

        $db->update(
            "UPDATE usuarios_temp SET nome = '$novoNome', telefone = '$novoTelefone' WHERE id_usuario = $idUsuario"
        );
    }

    public function excluirUsuarioTemp($idUsuario)
    {
        $db = new Database();

        $db->delete(
            "DELETE FROM usuarios_temp WHERE id_usuario = $idUsuario"
        );
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getIdRifa()
    {
        return $this->idRifa;
    }

    public function setIdRifa($idRifa)
    {
        $this->idRifa = $idRifa;
    }

    public function getNumeros()
    {
        return $this->numeros;
    }

    public function setNumeros($numeros)
    {
        $this->numeros = $numeros;
    }

    public function getQuantidadeNumeros($idUsuario)
    {
        // return count($this->numeros);

        $db = new Database();

        $qnt = $db->select(
            "SELECT COUNT(*) FROM numeros_comprados WHERE id_usuarios_temp = $idUsuario"
        );

        return $qnt[0]->{'COUNT(*)'};
    }
}
