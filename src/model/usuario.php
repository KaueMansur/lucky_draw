<?php

require "numeroComprado.php";
// if (!defined('MINHA_APLICACAO')) {
//     // Se tentarem acessar direto pela URL, essa constante não existirá
//     header('HTTP/1.0 403 Forbidden');
//     die('Acesso direto não permitido.');
// } 

class usuario
{

    private $idUsuario;
    private $nome;
    private $telefone;
    private $email;
    private $senha;
    private $idNumeros;
    private $numeros;
    private $idRifa;

    public function __construct($nome = 0, $telefone = 0, $idRifa = 0, $idUsuario = 0, $numeros = [])
    {
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->idRifa = $idRifa;
        $this->idUsuario = $idUsuario;
        $this->numeros = $numeros;
    }

    public function getObject()
    {
        return $this;
    }

    public function cadastrarUsuario($nome, $telefone = null, $email = null, $senha = null, $idRifa = null)
    {
        $db = new Database();

        if ($senha == null) {
            $db->insert(
                "INSERT INTO usuarios(nome, telefone, id_rifa) VALUES('$nome', '$telefone', $idRifa)"
            );
        } else {
            $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);
            $db->insert(
                "INSERT INTO usuarios(nome, telefone, email, senha) VALUES(:nome, :telefone, :email, :senha)",
                [
                    'nome' => $nome,
                    'telefone' => $telefone,
                    'email' => $email,
                    'senha' => $senhaSegura
                ]
            );
        }
    }

    public function listarNumerosDoUsuarioDaRifa($idUsuario, $idRifa)
    {
        $db = new Database();

        return $db->select(
            "SELECT numero FROM numeros_comprados WHERE id_usuario = $idUsuario AND id_rifa = $idRifa"
        );
    }

    public function listarNumerosDoUsuario($idUsuario)
    {
        $db = new Database();

        return $db->select(
            "SELECT numero FROM numeros_comprados WHERE id_usuario = $idUsuario"
        );
    }

    public function formatarTelefone($numeroTelefone)
    {
        $limpo = preg_replace("/[^0-9]/", "", $numeroTelefone);
        $qtd = strlen($limpo);

        if ($qtd === 11) {
            return sprintf(
                "(%s) %s-%s",
                substr($limpo, 0, 2),
                substr($limpo, 2, 5),
                substr($limpo, 7, 4)
            );
        } else if ($qtd === 10) {
            return sprintf(
                "(%s) %s-%s",
                substr($limpo, 0, 2),
                substr($limpo, 2, 4),
                substr($limpo, 6, 4)
            );
        }

        return $numeroTelefone;
    }
    // public function listarRifasComNumerosDoUsuario($idUsuario){
    //     $db = new Database();

    //     return $db->select(
    //         "SELECT id_rifa FROM `numeros_comprados` WHERE id_usuario = $idUsuario GROUP BY id_rifa;"
    //     );
    // }

    public function login($emailOuTelefone, $senha)
    {
        $db = new Database();

        $key = false;

        $listaUsuarios = $db->select(
            "SELECT * FROM usuarios"
        );

        if (strpos($emailOuTelefone, "@") !== false) {
            //email
            $this->email = $emailOuTelefone;
        } else {
            //telefone
            $this->telefone = $this->formatarTelefone($emailOuTelefone);
        }

        $this->senha = $senha;

        foreach ($listaUsuarios as $usuario) {
            if ($usuario->email == $this->email) {
                // $usuario->senha == $this->senha
                if (password_verify($this->senha, $usuario->senha)) {
                    $this->idUsuario = $usuario->id_usuario;
                    $this->nome = $usuario->nome;
                    $this->telefone = $usuario->telefone;
                    // $this->idNumeros = $usuario->id_numeros;

                    $key = true;
                }
            } else {
                if ($usuario->telefone == $this->telefone) {
                    if (password_verify($this->senha, $usuario->senha)) {
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

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($id)
    {
        $this->idUsuario = $id;
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getIdNumeros()
    {
        return $this->idNumeros;
    }

    public function setIdNumeros($id)
    {
        $this->idNumeros = $id;
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
}
