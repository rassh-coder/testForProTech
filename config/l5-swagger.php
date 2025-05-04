<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'L5 Swagger UI',
                'description' => 'Auto-generated API docs',
                'version' => '1.0.0',
            ],
            'routes' => [
                'api' => 'api/documentation',
                'docs' => 'docs',
                'oauth2_callback' => 'api/oauth2-callback',
                'middleware' => [
                    'api' => [],
                    'asset' => [],
                    'docs' => [],
                    'oauth2_callback' => [],
                ],
            ],
            'paths' => [
                'docs' => storage_path('api-docs'),
                'annotations' => [
                    base_path('app/Http/Controllers'),
                    base_path('swagger/schemas'),
                    base_path('swagger/responses'),
                    base_path('swagger/parameters'),
                ],

                'views' => base_path('resources/views/vendor/l5-swagger'),
            ],
            'security' => [
                /*
                Examples:
                SecurityScheme::SWAGGER_SECURITY_BASIC => [],
                'api_key' => [
                    'type' => SecurityScheme::API_KEY,
                    'description' => 'Api key auth',
                    'name' => 'api_key',
                    'in' => 'header',
                ],
                */
            ],
        ],
    ],
];
