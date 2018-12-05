<?php
namespace Modelo;

use \PDO;
use \Framework\DW3ImagemUpload;
use \Framework\DW3BancoDeDados;
use \Modelo\Agency;
use \Modelo\User;


class Bidding extends Modelo
{
    const FIND_BY_ID = 'SELECT * FROM biddings WHERE id = ? LIMIT 1';
    const FIND_BY_AGENCY_ID = 'SELECT * FROM biddings WHERE institutionId = ?';    
    const FIND_ALL = 'SELECT * FROM biddings';
    const FIND_ALL_CLOSED = 'SELECT * FROM biddings WHERE closed = 1';
    const FIND_ALL_OPEN = 'SELECT * FROM biddings WHERE closed = 0';
    const FIND_AND_PAGINATE = 'SELECT * FROM biddings ORDER BY id DESC LIMIT ? OFFSET ?';
    const FIND_LAST_SIX = 'SELECT * FROM biddings ORDER BY id DESC LIMIT 6';    
    const COUNT_ALL = 'SELECT count(id) FROM biddings';
    const FIND_BIDDING_AGENCY = 'SELECT institutionId FROM biddings WHERE id = ? LIMIT 1';    
    const INSERT = 'INSERT INTO biddings(title,description,institutionId,closed) VALUES (?, ?, ?,0)';
    const CLOSE_BIDDING = 'UPDATE biddings SET value = ?, userId = ?, closed = true WHERE id = ?;';
    private $id;
    private $title;
    private $institutionId;
    private $description;
    private $userId;
    private $value;
    private $photo;
    private $closed;

    public function __construct($title, $description, $institutionId, $photo = null, $value = null, $userId = null, $closed = false, $id = null){
        $this->id = $id;
        $this->title = $title;
        $this->institutionId = $institutionId;
        $this->description = $description;
        $this->photo = $photo;
        $this->value = $value;
        $this->closed = $closed;
        $this->userId = $userId;
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

    public function getUserId(){
        return $this->userId;
    }

    protected function verificarErros()
    {
        if (strlen($this->title) < 8) {
            $this->setErroMensagem('title', 'Deve ter no mínimo 8 caracteres.');
        }
        if (strlen($this->description) < 10) {
            $this->setErroMensagem('description', 'Deve ter no mínimo 10 caracteres.');
        }
    }

    public function isClosed(){
        return $this->closed;
    }

    public function getWinner(){
        if($this->isClosed()){
            return User::findById($this->userId);
        }
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
                $registro['userId'],
                $registro['closed'],
                $registro['id']
            );
        }
        return $objeto;
    }

    public static function countAll()
    {
        $registros = DW3BancoDeDados::query(self::COUNT_ALL);
        $total = $registros->fetch();
        return intval($total[0]);
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
                $registro['value'],
                $registro['userId'],
                $registro['closed'],
                $registro['id']
            );
        }
        return $list;
    }

    public static function findAndPaginate($limit = 8, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_AND_PAGINATE);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $list = [];
        $registros = $comando->fetchAll();     
        foreach ($registros as $registro) {
            $list[] = new Bidding(
                $registro['title'],
                $registro['description'],
                $registro['institutionId'],
                null,
                $registro['value'],
                $registro['userId'],
                $registro['closed'],
                $registro['id']
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
                $registro['userId'],
                $registro['closed'],
                $registro['id']
            );
        }
        return $list;
    }

    public static function findLastSix()
    {
        $registros = DW3BancoDeDados::query(self::FIND_LAST_SIX);
        $list = [];
        foreach ($registros as $registro) {
            $list[] = new Bidding(
                $registro['title'],
                $registro['description'],
                $registro['institutionId'],
                null,
                $registro['value'],
                $registro['userId'],
                $registro['closed'],
                $registro['id']
            );
        }
        return $list;
    }

    public static function closeBidding($value, $userId, $ID)
    {
        $comando = DW3BancoDeDados::prepare(self::CLOSE_BIDDING);
        $comando->bindValue(1, $value, PDO::PARAM_STR);
        $comando->bindValue(2, $userId, PDO::PARAM_STR);
        $comando->bindValue(3, $ID, PDO::PARAM_STR);
        $comando->execute();
    }
    
    public static function filterBidding($filter, $limit = 8, $offset = 0){
        if ($filter == 'open') {
            $comando = DW3BancoDeDados::prepare(self::FIND_ALL_OPEN);
        } elseif ($filter == 'closed') {
            $comando = DW3BancoDeDados::prepare(self::FIND_ALL_CLOSED);
        } else {
            $comando = DW3BancoDeDados::prepare(self::FIND_AND_PAGINATE);            
        }
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $list = [];
        $registros = $comando->fetchAll();
        foreach ($registros as $registro) {
            $list[] = new Bidding(
                $registro['title'],
                $registro['description'],
                $registro['institutionId'],
                null,
                $registro['value'],
                $registro['userId'],
                $registro['closed'],
                $registro['id']
            );
        }
        return $list;
    }

    // public static function findAndPaginate($limit = 8, $offset = 0)
    // {
    //     $comando = DW3BancoDeDados::prepare(self::FIND_AND_PAGINATE);
    //     $comando->bindValue(1, $limit, PDO::PARAM_INT);
    //     $comando->bindValue(2, $offset, PDO::PARAM_INT);
    //     $comando->execute();
    //     $list = [];
    //     $registros = $comando->fetchAll();     
    //     foreach ($registros as $registro) {
    //         $list[] = new Bidding(
    //             $registro['title'],
    //             $registro['description'],
    //             $registro['institutionId'],
    //             null,
    //             $registro['value'],
    //             $registro['userId'],
    //             $registro['closed'],
    //             $registro['id']
    //         );
    //     }
    //     return $list;
    // }

}