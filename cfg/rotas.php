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
    ],
    '/agency/biddings' => [
        'GET' => '\Controlador\AgencyControlador#biddings'
    ], // Licitações 
    '/biddings' => [
        'GET' => '\Controlador\BiddingsControlador#index'
    ],
    '/bidding/new' => [
        'GET' => '\Controlador\BiddingsControlador#new',
        'POST' => '\Controlador\BiddingsControlador#create'
    ],
    '/bidding/?' => [
        'GET' => '\Controlador\BiddingsControlador#show'
    ],
    '/bidding/close/?' => [
        'GET' => '\Controlador\BiddingsControlador#close'
    ], 
    '/bidding/filter' => [
        'POST' =>  '\Controlador\BiddingsControlador#filter'
    ],
    // Lance do usuário (empresa)
    '/user/bid/new' => [
        'POST' => '\Controlador\UserBidControlador#new'
    ],
    '/user/bid/update' => [
        'POST' => '\Controlador\UserBidControlador#update'
    ],
    '/user/bid/delete/?' => [
        'DELETE' => '\Controlador\UserBidControlador#delete'
    ],

];
