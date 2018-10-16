<?php
namespace Controlador;

use \Modelo\User;

class UserControlador extends Controlador
{
    public function index()
    {
        $this->visao('user/index.php');
    }

    public function new()
    {
        $this->visao('user/new.php');
    }

    public function create()
    {
        $user = new User($_POST['email'], $_POST['pwd'], $_POST['username']);

        if ($user->isValido()) {
            $user->save();
            $this->redirecionar(URL_RAIZ . 'user');
        } else {
            $this->setErros($user->getValidacaoErros());
            $this->visao('user/new.php');
        }
    }
}
