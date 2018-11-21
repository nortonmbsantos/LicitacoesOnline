<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Agency;
use \Modelo\User;
use \Modelo\Bidding;
use \Modelo\UserBid;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Carregador;

class TesteUserBid extends Teste
{
    private $userId;
    private $biddingId;

    public function antes()
    {
        $agency = new Agency('agency@teste.com', 'senha', 'teste');
        $agency->save();
        $bidding = new Bidding('Teste', 'Isto é apenas um teste', $agency->getId());
        $bidding->save();
        $this->biddingId = $bidding->getId();
        $user = new User('user@teste.com', 'senha', 'teste');
        $user->save();
        $this->userId = $user->getId();
    }

    public function testeInsert()
    {
        $userBid = new UserBid($this->userId, $this->biddingId, 156);
        $userBid->save();
        $query = DW3BancoDeDados::query("SELECT * FROM user_bid WHERE id = " . $userBid->getId());
        $bdUserBid = $query->fetch();
        $this->verificar($bdUserBid["value"] === (string)$userBid->getValue());
    }

    public function testeUpdate(){
        $userBid = new UserBid($this->userId, $this->biddingId, 156);
        $userBid->save();
        
        $userBid = new UserBid($this->userId, $this->biddingId, 180,  $userBid->getId());
        $userBid->update($userBid->getId());

        $query = DW3BancoDeDados::query("SELECT * FROM user_bid WHERE id = " . $userBid->getId());
        $bdUserBid = $query->fetch();
        $this->verificar($bdUserBid["value"] === (string)180);
    }

    public function testeFindByBidding(){
        $userBid = new UserBid($this->userId, $this->biddingId, 156);
        $userBid->save();
        $list = UserBid::findByBidding($this->biddingId);

        $this->verificar($list[0]->getValue() === (string)156);
    }

}