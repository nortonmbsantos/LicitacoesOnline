<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\User;
use \Modelo\Agency;
use \Modelo\Bidding;

class AppControlador extends Controlador
{
    public function index()
    {
        $biddings = Bidding::findLastSix();
        $this->visao('inicial/index.php', 
        ['user' => $this->getUser(),  'agency' => $this->getAgency(),
         'biddings' => $biddings, 'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
         ]);
    }
    
}
