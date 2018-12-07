<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Modelo\Bidding;
use \Modelo\User;

class UserBid extends Modelo
{
    const FIND_BY_ID = 'SELECT * FROM user_bid WHERE id = ? LIMIT 1';
    const DELETE_BY_ID = 'DELETE FROM user_bid WHERE id = ? LIMIT 1';
    const FIND_BY_BIDDING_ID = 'SELECT * FROM user_bid WHERE biddingId = ?';    
    const FIND_BY_USER_AND_BIDDING = 'SELECT * FROM user_bid WHERE userId = ? AND biddingId = ?';
    const FIND_BEST_BID = 'SELECT * FROM user_bid WHERE biddingId = ? AND value = (select MIN(value) from user_bid) LIMIT 1'; //nã retorna o id e userId certos 
    const FIND_ALL = 'SELECT * FROM user_bid';  
    const DELETE_BY_USERID_AND_BIDDINGID = 'DELETE FROM user_bid WHERE userId = ? AND biddingId = ? LIMIT 1';
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

    public function setValue($newValue){
        $this->value = $newValue;
    }

    protected function verificarErros()
    {
        if ($this->value <= 0) {
            $this->setErroMensagem('value', 'Deve ser um número maior do que zero.');
        }
        if (!is_numeric($this->value)) {
            $this->setErroMensagem('value', 'Valor deve ser um número.');
        }
        if(UserBid::FindById($this->id) != null){
            if(UserBid::FindById($this->id)->getValue() == $this->value){
                $this->setErroMensagem('value', 'Valor deve ser diferente do seu lance já existente.');
            }
        }
    }

    public function save()
    {
        $this->insert();
    }

    public function delete()
    {
        $this->deleteById($this->id);
    }

    public function update()
    {
        $old = UserBid::findById($this->id);
        if($old->getValue() != $this->getValue()){
            $this->delete();
            $this->save();
        }
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
    
    public static function deleteById($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETE_BY_ID);
        $comando->bindValue(1, $id, PDO::PARAM_STR);
        $comando->execute();
    }

    public static function deleteByUserIdAndBiddingId($userId, $biddingId)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETE_BY_USERID_AND_BIDDINGID);
        $comando->bindValue(1, $userId, PDO::PARAM_STR);
        $comando->bindValue(2, $biddingId, PDO::PARAM_STR);
        $comando->execute();
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

    public static function findByUserAndBidding($userId, $biddingId)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_BY_USER_AND_BIDDING);
        $comando->bindValue(1, $userId, PDO::PARAM_STR);
        $comando->bindValue(2, $biddingId, PDO::PARAM_STR);
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


//pesquisa não esta retornando um objeto real, apenas alguns dados soltos;
    public static function findBiddingToClose($ID)
    {
        $comando = DW3BancoDeDados::prepare(self::FIND_BEST_BID);
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

}