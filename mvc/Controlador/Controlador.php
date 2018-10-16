<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;
use \Modelo\User;

abstract class Controlador extends DW3Controlador
{
    use ControladorVisao;
    
    protected $user;

	protected function verificarLogado()
    {
    	$user = $this->getUser();
        if ($user == null) {
        	$this->redirecionar(URL_RAIZ);
        }
    }

    protected function getUser()
    {
        if ($this->user == null) {
        	$user = DW3Sessao::get('user');
        }
        return $user;
    }
}