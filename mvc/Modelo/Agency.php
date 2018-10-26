<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Agency extends Modelo
{
    const FIND_BY_EMAIL = 'SELECT * FROM public_agencies WHERE email = ? LIMIT 1';
    const FIND_BY_ID = 'SELECT * FROM public_agencies WHERE id = ? LIMIT 1';
    const INSERT = 'INSERT INTO public_agencies(email,pwd, agency_name) VALUES (?, ?, ?)';
    private $id;
    private $email;
    private $agencyName;
    private $pwd;
    private $senhaPlana;

    public function __construct(
        $email,
        $pwd,
        $agencyName,
        $id = null
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->agencyName = $agencyName;
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

    public function getAgencyName()
    {
        return $this->agencyName;
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
        $comando->bindValue(3, $this->agencyName, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function verifyPwd($senhaPlana)
    {
        return password_verify($senhaPlana, $this->pwd);
    }

    public static function findByEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_BY_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Agency(
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
            $objeto = new Agency(
                $registro['email'],
                '',
                $registro['agency_name'],
                $registro['id']
            );
            $objeto->pwd = $registro['pwd'];
        }
        return $objeto;
    }

}
