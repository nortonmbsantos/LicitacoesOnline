<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class User extends Modelo
{
    const FIND_BY_EMAIL = 'SELECT * FROM users WHERE email = ? LIMIT 1';
    const FIND_BY_ID = 'SELECT * FROM users WHERE id = ? LIMIT 1';
    const INSERT = 'INSERT INTO users(email,pwd, username) VALUES (?, ?, ?)';
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

    public function verifyPwd($senhaPlana)
    {
        return password_verify($senhaPlana, $this->pwd);
    }

    protected function verificarErros()
    {
        if (strlen($this->email) < 8) {
            $this->setErroMensagem('email', 'Deve ter no mínimo 8 caracteres.');
        }
        if (strlen($this->username) < 6) {
            $this->setErroMensagem('username', 'Deve ter no mínimo 6 caracteres.');
        }
        if (strlen($this->senhaPlana) < 6) {
            $this->setErroMensagem('pwd', 'Deve ter no mínimo 6 caracteres.');
        }
    }

    public function save()
    {
        $this->insert();
    }

    private function insert()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERT);
        $comando->bindValue(1, $this->email, PDO::PARAM_STR);
        $comando->bindValue(2, $this->pwd, PDO::PARAM_STR);
        $comando->bindValue(3, $this->username, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function findByEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_BY_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new User(
                $registro['email'],
                '',
                null,
                $registro['id']
            );
            $objeto->pwd = $registro['pwd'];
        }
        return $objeto;
    }
    
    public static function findById($ID)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_BY_ID);
        $comando->bindValue(1, $ID, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new User(
                $registro['email'],
                '',
                $registro['username'],
                $registro['id']
            );
            $objeto->pwd = $registro['pwd'];
        }
        return $objeto;
    }


}
