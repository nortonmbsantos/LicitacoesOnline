<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Agency;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Carregador;

class TesteAgency extends Teste
{

    public function testeInsert(){
        $agency = new Agency('email@teste.com', 'senha', 'teste');
        $agency->save();
        $query = DW3BancoDeDados::query("SELECT * FROM public_agencies WHERE agency_name = 'teste'");
        $bdAgency = $query->fetch();
        $this->verificar($bdAgency !== false);

    }

    public function testeFindByEmail()
    {
        $agency = new Agency('email@teste.com', 'senha', 'teste');
        $agency->save();
        $agency = Agency::findByEmail('email@teste.com');
        $this->verificar($agency !== false);
    }

    public function testeFindById()
    {
        $agency = new Agency('email@teste.com', 'senha', 'teste');
        $agency->save();
        $agency = Agency::findById($agency->getId());
        $this->verificar($agency !== false);
    }

}

