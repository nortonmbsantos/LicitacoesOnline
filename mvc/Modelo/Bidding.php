<?php
namespace Modelo;

use \PDO;
use \Framework\DW3ImagemUpload;
use \Framework\DW3BancoDeDados;
use \Modelo\Agency;


class Bidding extends Modelo
{
    const FIND_BY_ID = 'SELECT * FROM biddings WHERE id = ? LIMIT 1';
    const FIND_BY_AGENCY_ID = 'SELECT * FROM biddings WHERE institutionId = ?';    
    const FIND_ALL = 'SELECT * FROM biddings';    
    const FIND_BIDDING_AGENCY = 'SELECT institutionId FROM biddings WHERE id = ? LIMIT 1';    
    const INSERT = 'INSERT INTO biddings(title,description,institutionId) VALUES (?, ?, ?)';
    private $id;
    private $title;
    private $institutionId;
    private $description;
    private $userId;
    private $value;
    private $photo;

    public function __construct($title, $description, $institutionId, $photo = null, $value = null, $id = null){
        $this->id = $id;
        $this->title = $title;
        $this->institutionId = $institutionId;
        $this->description = $description;
        $this->photo = $photo;
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

    public function getImage()
    {
        $imageName = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imageName)) {
            $imageName = 'default-image.png';
        }
        return $imageName;
    }

    public function getInstitution(){
        return Agency::findById($this->getInstitutionId());
    }

    public function getInstitutionName(){
        return $this->getInstitution()->getAgencyName();
    }

    public function getValue(){
        return $this->value;
    }

    public function save()
    {
        $this->insert();
        if($this->saveImage()){
            var_dump("ok");
        }
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

    private function saveImage()
    {
        if (DW3ImagemUpload::isValida($this->photo)) {
            $path = PASTA_PUBLICO . "img/{$this->id}.png";
            DW3ImagemUpload::salvar($this->photo, $path);
        }
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
                null,
                $registro['value'],
                $registro['id']
            );
        }
        return $objeto;
    }

    public static function findByAgency($ID)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_BY_AGENCY_ID);
        $comando->bindValue(1, $ID, PDO::PARAM_STR);
        $comando->execute();
        $list = [];
        $registros = $comando->fetchAll();     
        foreach ($registros as $registro) {
            $list[] = new Bidding(
                $registro['title'],
                $registro['description'],
                $registro['institutionId'],
                null,
                $registro['value']
            );
        }
        return $list;
    }

    public static function findAll()
    {
        $registros = DW3BancoDeDados::query(self::FIND_ALL);
        $list = [];
        foreach ($registros as $registro) {
            $list[] = new Bidding(
                $registro['title'],
                $registro['description'],
                $registro['institutionId'],
                null,
                $registro['value'],
                $registro['id']
            );
        }
        return $list;
    }
}