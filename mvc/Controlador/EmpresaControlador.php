<?php
namespace Controlador;

class EmpresaControlador extends Controlador
{
    public function index()
    {
        $this->visao('empresa/index.php');
    }
    public function new()
    {
        $this->visao('empresa/new.php');
    }
}
