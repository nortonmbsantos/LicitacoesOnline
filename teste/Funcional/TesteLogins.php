<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Agency;
use \Modelo\User;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Carregador;
use \Framework\DW3Sessao;

class TesteLogins extends Teste
{

    public function testeAcessAgencyLogin()
    {
        $resposta = $this->get(URL_RAIZ . 'agency/login/new');
        $this->verificarContem($resposta, 'Login');
    }
    
    public function testeAcessUserLogin()
    {
        $resposta = $this->get(URL_RAIZ . 'user/login/new');
        $this->verificarContem($resposta, 'Login');
    }

    public function testeInvalidUserLogin()
    {
        $resposta = $this->post(URL_RAIZ . 'user/login/new', [
            'email' => 'joao@teste.com',
            'pwd' => '1'
        ]);
        $this->verificarContem($resposta, 'joao@teste.com');
        $this->verificar(DW3Sessao::get('user') == null);
    }

    public function testeUserLogin()
    {
        (new user('user@teste.com', '123456', 'User'))->save();
        $resposta = $this->post(URL_RAIZ . 'user/login/new', [
            'email' => 'user@teste.com',
            'pwd' => '123456'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ);
        $this->verificar(DW3Sessao::get('user') != null);
    }

    public function testeUserLogOut(){
        (new user('user@teste.com', '123456', 'User'))->save();
        $resposta = $this->post(URL_RAIZ . 'user/login/new', [
            'email' => 'user@teste.com',
            'pwd' => '123456'
        ]);

        $resposta = $this->get(URL_RAIZ . 'user/logout');
        $this->verificarRedirecionar($resposta, URL_RAIZ);
        $this->verificar(DW3Sessao::get('user') == null);   
    }

    public function testeInvalidAgencyLogin()
    {
        $resposta = $this->post(URL_RAIZ . 'agency/login/new', [
            'email' => 'joao@teste.com',
            'pwd' => '1'
        ]);
        $this->verificarContem($resposta, 'joao@teste.com');
        $this->verificar(DW3Sessao::get('agency') == null);
    }

    public function testeAgencyLogin()
    {
        (new Agency('agency@teste.com', '123456', 'Agency'))->save();
        $resposta = $this->post(URL_RAIZ . 'agency/login/new', [
            'email' => 'agency@teste.com',
            'pwd' => '123456'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ);
        $this->verificar(DW3Sessao::get('agency') != null);
    }

    public function testeAgencyLogOut(){
        (new Agency('agency@teste.com', '123456', 'Agency'))->save();
        $resposta = $this->post(URL_RAIZ . 'agency/login/new', [
            'email' => 'agency@teste.com',
            'pwd' => '123456'
        ]);
        
        $resposta = $this->get(URL_RAIZ . 'agency/logout');
        $this->verificarRedirecionar($resposta, URL_RAIZ);
        $this->verificar(DW3Sessao::get('agency') == null);   
    }

}