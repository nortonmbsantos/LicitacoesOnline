<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Agency;
use \Modelo\Bidding;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Carregador;

class TesteBidding extends Teste
{
    private $agencyId;

    public function antes()
    {
        $agency = new Agency('email@teste.com', 'senha', 'teste');
        $agency->save();
        $this->agencyId = $agency->getId();
    }

    public function testeInsert()
    {
        $bidding = new Bidding('Teste', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $query = DW3BancoDeDados::query("SELECT * FROM biddings WHERE id = " . $bidding->getId());
        $bdBidding = $query->fetch();
        $this->verificar($bdBidding['title'] === $bidding->getTitle());
        $this->verificar($bdBidding['description'] === $bidding->getDescription());
        $this->verificar($bdBidding['institutionId'] === $bidding->getInstitutionId());
    }

    public function testeFindById(){
        $bidding = new Bidding('Teste', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $bidding = Bidding::findById($bidding->getId());
        $this->verificar($bidding !== false);
        
    }

    public function testeCountAll(){
        $bidding = new Bidding('Teste', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $this->verificar(Bidding::countAll() === 1);
        $bidding = new Bidding('Teste2', 'Isto é apenas um teste2', $this->agencyId);
        $bidding->save();
        $this->verificar(Bidding::countAll() === 2);
    }

    public function testeFindByAgency(){
        $bidding = new Bidding('Teste', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $bidding2 = new Bidding('Teste2', 'Isto é apenas um teste2', $this->agencyId);
        $bidding2->save();
        $db = Bidding::findByAgency($this->agencyId);
        $b1 = $db[0];
        $b2 = $db[1];        
        $this->verificar($b1->getTitle() === $bidding->getTitle());
        $this->verificar($b1->getDescription() === $bidding->getDescription());
        $this->verificar($b1->getInstitutionId() === $bidding->getInstitutionId());        
        $this->verificar($b2->getTitle() === $bidding2->getTitle());
        $this->verificar($b2->getDescription() === $bidding2->getDescription());
        $this->verificar($b2->getInstitutionId() === $bidding2->getInstitutionId());
    }

    public function testeFindAll(){
        $bidding = new Bidding('Teste', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $bidding2 = new Bidding('Teste2', 'Isto é apenas um teste2', $this->agencyId);
        $bidding2->save();
        $db = Bidding::findAll();
        $b1 = $db[0];
        $b2 = $db[1];        
        $this->verificar($b1->getTitle() === $bidding->getTitle());
        $this->verificar($b1->getDescription() === $bidding->getDescription());
        $this->verificar($b1->getInstitutionId() === $bidding->getInstitutionId());        
        $this->verificar($b2->getTitle() === $bidding2->getTitle());
        $this->verificar($b2->getDescription() === $bidding2->getDescription());
        $this->verificar($b2->getInstitutionId() === $bidding2->getInstitutionId());
    }

    public function testeFindLastSix(){
        $bidding = new Bidding('Teste', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $bidding = new Bidding('Teste2', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $bidding = new Bidding('Teste3', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $bidding = new Bidding('Teste4', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $bidding = new Bidding('Teste5', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $bidding = new Bidding('Teste6', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $bidding = new Bidding('Teste7', 'Isto é apenas um teste', $this->agencyId);
        $bidding->save();
        $db = Bidding::findLastSix();
        // $b = $db[0];
        // $this->verificar($b->getTitle() != 'Teste');
        // $b = $db[1];
        // $this->verificar($b->getTitle() != 'Teste');
        // $b = $db[2];
        // $this->verificar($b->getTitle() != 'Teste');
        // $b = $db[3];
        // $this->verificar($b->getTitle() != 'Teste');
        // $b = $db[4];
        // $this->verificar($b->getTitle() != 'Teste');
        $b = $db[5];
        $this->verificar($b->getTitle() != 'Teste');
    }

}