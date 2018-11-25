<?php
namespace Teste\Funcional;

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

    public function antes(){
        $agency = new Agency('agency@teste.com', '123456', 'agency');
        $agency->save();
        $bidding = new Bidding('Tentativa', 'Isto é apenas uma tentativa', $agency->getId());
        $bidding->save();
        $this->biddingId = $bidding->getId();
        $user = new User('user@teste.com', '123456', 'teste');
        $user->save();
        $this->userId = $user->getId();
        $userBid = new UserBid($this->userId, $this->biddingId, 156);
        $userBid->save();
        var_dump($userBid);
    }

    public function testeUserBidList(){
        $resposta = $this->post(URL_RAIZ . 'agency/login/new', [
            'email' => 'agency@teste.com',
            'pwd' => '123456'
        ]);
        $resposta = $this->get(URL_RAIZ . 'bidding/' . $this->biddingId);
        var_dump($this->verificar(strpos($resposta['html'], '156') !== false));
    }


}