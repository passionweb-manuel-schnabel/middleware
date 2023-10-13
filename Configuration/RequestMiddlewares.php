<?php

return [
    'frontend' => [
        'authentication-check' => [
            'target' => \Passionweb\Middleware\Middleware\AuthMiddleware::class,
            'before' => [
                'typo3/cms-frontend/base-redirect-resolver',
            ],
            'after' => [
                'typo3/cms-frontend/authentication',
            ],
            'disabled' => false,
        ]
    ]
];

