<?php
namespace Controlador;

use \Modelo\Bidding;
use \Modelo\Agency;
use \Modelo\UserBid;

class UserBidControlador extends Controlador
{
    public function new()
    {
        $bidding = Bidding::findById($_POST['biddingId']);
        $bid = new UserBid($_POST['userId'], $_POST['biddingId'], $_POST['value']);

        if ($bid->isValido()) {
            $bid->save();
            $this->redirecionar(URL_RAIZ . 'bidding/' . $_POST['biddingId']);            
        } else {
            $this->setErros($bid->getValidacaoErros());
            $this->visao('bidding/show.php', ['user' => $this->getUser(),  'agency' => $this->getAgency(), 'bidding' => $bidding]);
        }
    }

    public function update(){
        $userBid = UserBid::findByUserAndBidding($this->getUser()->getId(), $_POST['biddingId']);
        $bidding = Bidding::findById($_POST['biddingId']);        
        $bid = new UserBid($_POST['userId'], $_POST['biddingId'], $_POST['value']);

        if ($bid->isValido()) {
            $bid->update();
            $this->redirecionar(URL_RAIZ . 'bidding/' . $_POST['biddingId']);
        } else {
            $this->setErros($bid->getValidacaoErros());
            $this->visao('bidding/show.php', 
            ['user' => $this->getUser(),  'agency' => $this->getAgency(), 'bidding' => $bidding, 'userBid' => $userBid]);
        }
    }

    public function delete($id){
        $this->verifyUserLogedIn();
        var_dump("ola");
        $userBid = UserBid::findByUserAndBidding($this->getUser()->getId(), $_GET['biddingId']);
        $userBid->delete();
        // $this->redirecionar(URL_RAIZ . 'bidding/' . $_POST['biddingId']);
    }

}