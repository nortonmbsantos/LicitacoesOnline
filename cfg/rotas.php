<?php

$rotas = [ // Página inicial
    '/' => [
        'GET' => '\Controlador\AppControlador#index',
    ], // Usuário (empresas)
    '/user' => [ 
        'GET' => '\Controlador\UserControlador#index',
        'POST' => '\Controlador\UserControlador#create'
    ],
    '/user/new' => [
        'GET' => '\Controlador\UserControlador#new'
    ],
    '/user/login/new' => [
        'GET' => '\Controlador\UserLoginControlador#new',
        'POST' => '\Controlador\UserLoginControlador#session'
    ],
    '/user/logout' => [
        'GET' => '\Controlador\UserLoginControlador#destroy',
    ], // orgãos públicos
    '/agency' => [ 
        'GET' => '\Controlador\AgencyControlador#index',
        'POST' => '\Controlador\AgencyControlador#create'
    ],
    '/agency/new' => [
        'GET' => '\Controlador\AgencyControlador#new'
    ],
    '/agency/login/new' => [
        'GET' => '\Controlador\AgencyLoginControlador#new',
        'POST' => '\Controlador\AgencyLoginControlador#session'        
    ],
    '/agency/logout' => [
        'GET' => '\Controlador\AgencyLoginControlador#destroy'
    ], // Licitações 
    '/biddings' => [
        'GET' => '\Controlador\BinddingsControlador#index'
    ],
    '/bidding/new' => [
        'GET' => '\Controlador\BinddingsControlador#new',
        'POST' => '\Controlador\BinddingsControlador#create'
    ],
    '/bidding/?' => [
        'GET' => '\Controlador\BinddingsControlador#show'
    ],
];
