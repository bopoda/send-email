<?php

return [
    'default' => [
        'url' => '/',
        'controller' => '\Controller\EmailController',
        'action' => 'emailFormAction',
    ],
    'sendEmail' => [
        'url' => '/sendEmail',
        'controller' => '\Controller\EmailController',
        'action' => 'sendEmailAction',
    ],
];