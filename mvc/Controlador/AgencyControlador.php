<?php
namespace Controlador;

use \Modelo\Agency;

class AgencyControlador extends Controlador
{
    public function index()
    {
        $this->visao('agency/index.php');
    }

    public function new()
    {
        $this->visao('agency/new.php');
    }

    public function create()
    {
        $agency = new Agency($_POST['email'], $_POST['pwd'], $_POST['agencyname']);

        if ($agency->isValido()) {
            $agency->save();
            $this->redirecionar(URL_RAIZ . 'agency');
        } else {
            $this->setErros($agency->getValidacaoErros());
            $this->visao('agency/new.php');
        }
    }
}
