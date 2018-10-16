<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\AppControlador#index',
    ],
    '/user' => [ 
        'GET' => '\Controlador\UserControlador#index',
        'POST' => '\Controlador\UserControlador#create'
    ],
    '/user/new' => [
        'GET' => '\Controlador\UserControlador#new'
    ],
    '/user/bidding' => [
        'GET' => '\Controlador\BinddinsUserControlador#show'
    ],
    '/agency' => [ 
        'GET' => '\Controlador\AgencyControlador#index',
        'POST' => '\Controlador\AgencyControlador#create'
    ],
    '/agency/new' => [
        'GET' => '\Controlador\AgencyControlador#new'
    ], 
    '/user/login/new' => [
        'GET' => '\Controlador\UserLoginControlador#new',
        'POST' => '\Controlador\UserLoginControlador#session'
    ],
];
