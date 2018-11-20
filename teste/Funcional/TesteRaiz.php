<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteRaiz extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Licitações Online') !== false);
    }

    public function testeAgencyCard(){
	    $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Sou um Orgão Público') !== false);
        $this->verificar(strpos($resposta['html'], 'Cadastre-se') !== false);
        $this->verificar(strpos($resposta['html'], 'Login') !== false);
    }

   public function testeUserCard(){
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Sou uma empresa') !== false);
        $this->verificar(strpos($resposta['html'], 'Cadastre-se') !== false);
        $this->verificar(strpos($resposta['html'], 'Login') !== false);
   }
}
