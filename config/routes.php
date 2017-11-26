<?php

return [
    'default' => [
        'url' => '/',
        'controller' => '\Controller\EmailController',
        'action' => 'emailFormAction',
    ],
    'listEmail' => [
        'url' => '/list',
        'controller' => '\Controller\EmailController',
        'action' => 'listAction',
    ],
];