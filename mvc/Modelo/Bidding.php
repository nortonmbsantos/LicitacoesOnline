<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Bidding extends Modelo
{
    const FIND_BY_ID = 'SELECT * FROM biddings WHERE id = ? LIMIT 1';
    const INSERT = 'INSERT INTO biddings(title,description,institutionId) VALUES (?, ?, ?)';
    private $id;
    private $title;
    private $institutionId;
    private $description;
    private $value;

    public function __construct($title, $description, $institutionId, $value = null, $id = null){
        $this->id = $id;
        $this->title = $title;
        $this->institutionId = $institutionId;
        $this->description = $description;
        $this->value = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getInstitutionId(){
        return $this->institutionId;
    }

    public function getValue(){
        return $this->value;
    }

    public function save()
    {
        $this->insert();
    }

    private function insert()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERT);
        $comando->bindValue(1, $this->title, PDO::PARAM_STR);
        $comando->bindValue(2, $this->description, PDO::PARAM_STR);
        $comando->bindValue(3, $this->institutionId, PDO::PARAM_INT);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function findById($ID)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_BY_ID);
        $comando->bindValue(1, $ID, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Bidding(
                $registro['title'],
                $registro['description'],
                $registro['institutionId'],
                $registro['value']
            );
        }
        return $objeto;
    }
}