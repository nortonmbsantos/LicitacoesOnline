<?php
namespace Controlador;

use \Modelo\Bidding;
use \Modelo\Agency;
use \Modelo\UserBid;

class BinddingsControlador extends Controlador
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
        $this->visao('bidding/show.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency(), 'bidding' => $bidding]);
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
    
    public function bid()
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

}
