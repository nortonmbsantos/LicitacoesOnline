<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Agency;
use \Modelo\Bidding;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Carregador;

class TesteBiddingScreens extends Teste
{
    private $agencyId;
    private $biddingId;

    public function antes()
    {
        $agency = new Agency('email@teste.com', 'senha', 'teste');
        $agency->save();
        $this->agencyId = $agency->getId();

        $this->post(URL_RAIZ . 'agency/login/new', [
            'email' => 'email@teste.com',
            'pwd' => 'senha'
        ]);

        $bidding = new Bidding('Teste', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $this->biddingId = $bidding->getId();
    }

    public function testeShow(){
        $resposta = $this->get(URL_RAIZ . 'bidding/' . $this->biddingId);
        $this->verificar(strpos($resposta['html'], 'Teste') !== false);
        $this->verificar(strpos($resposta['html'], 'Isto é apenas um teste') !== false);
        $this->get(URL_RAIZ . 'agency/logout');
    }

    public function testeIndex(){
        $bidding2 = new Bidding('Teste2', 'Isto é apenas um teste2', $this->agencyId);
        $bidding2->save();

        $resposta = $this->get(URL_RAIZ . 'biddings');
        $this->verificar(strpos($resposta['html'], 'Teste') !== false);
        $this->verificar(strpos($resposta['html'], 'Isto é apenas um teste') !== false);
        $this->verificar(strpos($resposta['html'], 'Teste2') !== false);
        $this->verificar(strpos($resposta['html'], 'Isto é apenas um teste2') !== false);
        $this->get(URL_RAIZ . 'agency/logout');
    }

}