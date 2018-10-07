<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\AppControlador#index',
    ],
    '/empresa' => [ 
        'GET' => '\Controlador\EmpresaControlador#index'
    ],
    '/empresa/new' => [
        'GET' => '\Controlador\EmpresaControlador#new'
    ],
    '/empresa/licitacao' => [
        'GET' => '\Controlador\LicitacaoEmpresaControlador#show'
    ], 

];
