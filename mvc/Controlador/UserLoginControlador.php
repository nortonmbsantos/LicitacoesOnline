<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\User;

class UserLoginControlador extends Controlador
{
    public function new()
    {
        $this->visao('user/login/new.php', ['user' => $this->getUser(), 'agency' => $this->getAgency()]);
    }

    public function session()
    {
        $user = User::findByEmail($_POST['email']);
        if ($user && $user->verifyPwd($_POST['pwd'])) {
            DW3Sessao::set('user', $user->getId());
            DW3Sessao::setFlash('mensagemFlash', 'Login efetuado com sucesso.');
            $this->redirecionar(URL_RAIZ);
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('user/login/new.php', ['user' => $this->getUser(), 'agency' => $this->getAgency()]);
        }
    }

    public function destroy()
    {
        DW3Sessao::deletar('user');
        DW3Sessao::setFlash('mensagemFlash', 'Logout efetuado com sucesso.');
        $this->redirecionar(URL_RAIZ);
    }
}
