<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;
use \Modelo\User;
use \Modelo\Agency;

abstract class Controlador extends DW3Controlador
{
    use ControladorVisao;
    
    protected $user;
    protected $agency;    

	protected function verifyUserLogedIn()
    {
    	$user = $this->getUser();
        if ($user == null) {
        	$this->redirecionar(URL_RAIZ);
        }
    }

	protected function verifyAgencyLogedIn()
    {
        $agency = $this->getAgency();
        if ($agency == null) {
        	$this->redirecionar(URL_RAIZ);
        }
    }

    protected function verifyLogedIn()
    {
        $agency = $this->getAgency();
    	$user = $this->getUser();
        if ($user == null && $agency == null) {
        	$this->redirecionar(URL_RAIZ);
        }
    }
    
    protected function getUser()
    {
        if ($this->user == null) {
            $user = User::findById(DW3Sessao::get('user'));
        }
        return $user;
    }

    protected function getAgency()
    {
        if ($this->agency == null) {
            $agency = Agency::findById(DW3Sessao::get('agency'));
        }
        return $agency;
    }

}