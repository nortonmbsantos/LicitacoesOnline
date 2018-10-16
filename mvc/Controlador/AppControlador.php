<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\User;

class AppControlador extends Controlador
{
    public function index()
    {
        $user = User::findById($this->getUser());
        $this->visao('inicial/index.php', ['user' => $user]);
    }
}
