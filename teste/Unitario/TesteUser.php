<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\User;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Carregador;

class TesteUser extends Teste
{

    public function testeInsert(){
        $user = new User('email@teste.com', 'senha', 'teste');
        $user->save();
        $query = DW3BancoDeDados::query("SELECT * FROM users WHERE username = 'teste'");
        $bdUsuairo = $query->fetch();
        $this->verificar($bdUsuairo !== false);

    }

    public function testeFindByEmail()
    {
        $user = new User('email@teste.com', 'senha', 'teste');
        $user->save();
        $user = User::findByEmail('email@teste.com');
        $this->verificar($user !== false);
    }

    public function testeFindById()
    {
        $user = new User('email@teste.com', 'senha', 'teste');
        $user->save();
        $user = User::findById($user->getId());
        $this->verificar($user !== false);
    }
}

