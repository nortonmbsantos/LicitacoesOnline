<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\User;
use \Modelo\Bidding;

class AppControlador extends Controlador
{
    public function index()
    {
        $biddings = Bidding::findAll();
        $this->visao('inicial/index.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency(), 'biddings' => $biddings]);
    }
    
}
