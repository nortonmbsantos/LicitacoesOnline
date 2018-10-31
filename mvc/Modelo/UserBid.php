<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Modelo\Bidding;
use \Modelo\User;

class UserBid extends Modelo
{
    const FIND_BY_ID = 'SELECT * FROM user_bid WHERE id = ? LIMIT 1';
    const FIND_BY_BIDDING_ID = 'SELECT * FROM user_bid WHERE biddingId = ?';    
    const FIND_ALL = 'SELECT * FROM user_bid';  
    const INSERT = 'INSERT INTO user_bid(biddingId,userId,value) VALUES (?, ?, ?)';
    
    private $id;
    private $userId;
    private $biddingId;
    private $value;

    public function __construct($userId, $biddingId, $value, $id = null){
        $this->id = $id;
        $this->userId = $userId;
        $this->biddingId = $biddingId;
        $this->value = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getUser(){
        return User::findById($this->userId);
    }

    public function getBiddingId(){
        return $this->biddingId;
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
        $comando->bindValue(1, $this->biddingId, PDO::PARAM_STR);
        $comando->bindValue(2, $this->userId, PDO::PARAM_STR);
        $comando->bindValue(3, $this->value, PDO::PARAM_INT);
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
            $objeto = new UserBid(
                $registro['userId'],
                $registro['biddingId'],
                $registro['value'],
                $registro['id']
            );
        }
        return $objeto;
    }

    public static function findByBidding($ID)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_BY_BIDDING_ID);
        $comando->bindValue(1, $ID, PDO::PARAM_STR);
        $comando->execute();
        $list = [];
        $registros = $comando->fetchAll();     
        foreach ($registros as $registro) {
            $list[] = new UserBid(
                $registro['userId'],
                $registro['biddingId'],
                $registro['value'],
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
            $list[] = new UserBid(
                $registro['userId'],
                $registro['biddingId'],
                $registro['value'],
                $registro['id']
            );
        }
        return $list;
    }
}