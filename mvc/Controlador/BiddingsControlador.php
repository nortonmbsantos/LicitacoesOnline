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
        $this->visao('bidding/index.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency(), 'biddings' => $biddings]);
    }

    public function show($id)
    {
        $this->verifyLogedIn();
        $bidding = Bidding::findById($id);
        $bids = UserBid::findByBidding($id);
        $this->visao('bidding/show.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency(), 'bidding' => $bidding, 'bids' => $bids]);
    }

    public function new()
    {
        $this->verifyAgencyLogedIn();
        $this->visao('bidding/new.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
    }

    public function create()
    {
        $bidding = new Bidding($_POST['title'], $_POST['description'], $_POST['institutionId']);

        if ($bidding->isValido()) {
            $bidding->save();
            $this->redirecionar(URL_RAIZ . 'agency/biddings');
        } else {
            $this->setErros($bidding->getValidacaoErros());
            $this->visao('bidding/new.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
        }
    }

}
