<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Agency;

class AgencyLoginControlador extends Controlador
{
    public function new()
    {
        $this->visao('agency/login/new.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
    }

    public function session()
    {
        $agency = Agency::findByEmail($_POST['email']);
        if ($agency && $agency->verifyPwd($_POST['pwd'])) {
            DW3Sessao::set('agency', $agency->getId());
            DW3Sessao::setFlash('mensagemFlash', 'Login efetuado com sucesso.');            
            $this->redirecionar(URL_RAIZ);
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('agency/login/new.php', 
            ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency(),
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function destroy()
    {
        DW3Sessao::deletar('agency');
        DW3Sessao::setFlash('mensagemFlash', 'Logout efetuado com sucesso.');
        $this->redirecionar(URL_RAIZ);
    }
}
