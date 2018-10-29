<?php
namespace Controlador;

use \Modelo\Agency;
use \Modelo\Bidding;

class AgencyControlador extends Controlador
{
    public function index()
    {
        $this->visao('agency/index.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
    }

    public function new()
    {
        $this->visao('agency/new.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
    }

    public function create()
    {
        $agency = new Agency($_POST['email'], $_POST['pwd'], $_POST['agencyname']);

        if ($agency->isValido()) {
            $agency->save();
            $this->redirecionar(URL_RAIZ . 'agency');
        } else {
            $this->setErros($agency->getValidacaoErros());
            $this->visao('agency/new.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
        }
    }

    public function biddings()
    {
        $biddings = Bidding::findByAgency($this->getAgency()->getId());
        $this->visao('agency/biddings/index.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency(), 'biddings' => $biddings]);
    }

}
