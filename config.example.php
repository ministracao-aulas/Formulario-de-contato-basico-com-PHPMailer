<?php

use PHPMailer\PHPMailer\PHPMailer;

define('APP_PATH', __DIR__);
define('DEBUG', true);

define('CONFIG', [
    'email' => [
        'Host'       => 'smtp.example.com',
        'SMTPAuth'   => true,
        'Username'   => 'user@example.com',
        'Password'   => 'secret',
        'SMTPSecure' => 'tls',  // tls|ssl
        'Port'       => 465,

        'debug'      => [
            'enabled' => true,
            'level' => 2,
        ],

        // Recipients
        'addAddress' => [
            ['joe@example.net', 'Joe User'],
            ['info@example.com', 'Information'],
        ],
        'addReplyTo' => ['joe@example.net', 'Joe User',],
    ],
]);
