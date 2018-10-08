<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class User extends Modelo
{
    const FIND_BY_EMAIL = 'SELECT * FROM users WHERE email = ? LIMIT 1';
    const INSERT = 'INSERT INTO users(username,email,pwd) VALUES (?, ?, ?)';
    private $id;
    private $email;
    private $username;
    private $pwd;
    private $senhaPlana;

    public function __construct(
        $email,
        $pwd,
        $username,
        $id = null
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->senhaPlana = $pwd;
        $this->pwd = password_hash($pwd, PASSWORD_BCRYPT);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->pwd);
    }

    protected function verificarErros()
    {
        if (strlen($this->email) < 3) {
            $this->setErroMensagem('email', 'Deve ter no mínimo 3 caracteres.');
        }
        if (strlen($this->senhaPlana) < 3) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 3 caracteres.');
        }
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERT);
        $comando->bindValue(1, $this->email, PDO::PARAM_STR);
        $comando->bindValue(2, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function findEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_BY_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['email'],
                '',
                null,
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }
}
