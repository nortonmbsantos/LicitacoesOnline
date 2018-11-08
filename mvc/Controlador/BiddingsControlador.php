<?php
namespace Controlador;

use \Modelo\Bidding;
use \Modelo\Agency;
use \Modelo\UserBid;

class BiddingsControlador extends Controlador
{

    public function index()
    {
        $this->verifyLogedIn();
        $biddings = Bidding::findAll();
        $this->visao('bidding/index.php', ['user' => $this->getUser(),  'agency' => $this->getAgency(), 'biddings' => $biddings]);
    }

    public function show($id)
    {
        $this->verifyLogedIn();
        $bidding = Bidding::findById($id);
        $bids = UserBid::findByBidding($id);
        if($this->user){
            $userBid = UserBid::findByUserAndBidding($this->getUser()->getId(), $id);
        }else{
            $userBid = null;
        }
        $this->visao('bidding/show.php', 
        ['user' => $this->getUser(),  'agency' => $this->getAgency(), 'bidding' => $bidding, 'bids' => $bids, 'userBid' => $userBid]);
    }

    public function new()
    {
        $this->verifyAgencyLogedIn();
        $this->visao('bidding/new.php', ['user' => $this->getUser(),  'agency' => $this->getAgency()]);
    }

    public function create()
    {
        $photo = array_key_exists('photo', $_FILES) ? $_FILES['photo'] : null;
        $bidding = new Bidding($_POST['title'], $_POST['description'], $_POST['institutionId'], $photo);

        if ($bidding->isValido()) {
            $bidding->save();
            $this->redirecionar(URL_RAIZ . 'agency/biddings');
        } else {
            $this->setErros($bidding->getValidacaoErros());
            $this->visao('bidding/new.php', ['user' => $this->getUser(),  'agency' => $this->getAgency()]);
        }
    }

}
