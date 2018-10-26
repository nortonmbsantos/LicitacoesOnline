<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\User;

class AppControlador extends Controlador
{
    public function index()
    {
        $this->visao('inicial/index.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
    }
}
