<?php
namespace Controlador;

use \Modelo\Bidding;
use \Modelo\Agency;
 
class BinddingsControlador extends Controlador
{

    public function index()
    {
        $this->visao('bidding/index.php', ['user' => $user = $this->getUser()]);
    }

    public function show($id)
    {
        $bidding = Bidding::findById($id);
        $this->visao('bidding/show.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency(), 'bidding' => $bidding]);
    }

    public function new()
    {
        $this->verifyAgencyLogedIn();
        $this->visao('bidding/new.php', ['user' => $user = $this->getUser()]);
    }

    public function create()
    {
        $bidding = new Bidding($_POST['title'], $_POST['description'], $_POST['institutionId']);

        if ($bidding->isValido()) {
            $bidding->save();
            $this->redirecionar(URL_RAIZ . 'agency/biddings');
        } else {
            $this->setErros($bidding->getValidacaoErros());
            $this->visao('bidding/new.php');
        }
    }
}
