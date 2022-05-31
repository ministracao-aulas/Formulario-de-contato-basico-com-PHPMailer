<?php

return [
    '/' => function () {
        require __DIR__ . '/pages/home/index.php';
    },

    '/contact' => function () {
        require __DIR__ . '/pages/contact/contact.php';
    },

    '/contact-send' => function () {
        require __DIR__ . '/pages/contact/contactSend.php';
    },

    '/contact-success' => function () {
        require __DIR__ . '/pages/contact/contactSuccess.php';
    },
];
