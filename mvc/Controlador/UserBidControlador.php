<?php
namespace Controlador;

use \Modelo\Bidding;
use \Modelo\Agency;
use \Modelo\UserBid;

class UserBidControlador extends Controlador
{
    public function new()
    {
        echo 'ok';
        $bidding = Bidding::findById($_POST['biddingId']);
        $bid = new UserBid($_POST['userId'], $_POST['biddingId'], $_POST['value']);

        if ($bid->isValido()) {
            $bid->save();
            $this->redirecionar(URL_RAIZ . 'biddings');
        } else {
            $this->setErros($bid->getValidacaoErros());
            $this->visao('bidding/show.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency(), 'bidding' => $bidding]);
        }
    }

    public function update(){
        
    }

}