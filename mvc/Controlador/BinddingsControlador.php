<?php
namespace Controlador;

use \Modelo\Bidding;
 
class BinddingsControlador extends Controlador
{

    public function index()
    {
        $this->visao('bidding/index.php', ['user' => $user = $this->getUser()]);
    }

    public function show()
    {
        $this->visao('bidding/show.php', ['user' => $user = $this->getUser()]);
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
            $this->redirecionar(URL_RAIZ . 'biddings');
        } else {
            $this->setErros($bidding->getValidacaoErros());
            $this->visao('bidding/new.php');
        }
    }
}
