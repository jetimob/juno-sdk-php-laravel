<?php

return [
    'private_token' => env('JUNO_PRIVATE_TOKEN', ''),

    'clientId' => env('JUNO_CLIENT_ID', ''),
    'secret'   => env('JUNO_CLIENT_SECRET', ''),

    'gruzzle' => [
        'base_uri' => [
            'sandbox'    => 'https://sandbox.boletobancario.com/api-integration/',
            'production' => 'https://api.juno.com.br',
        ],

        'authorization_base_uri' => [
            'sandbox'    => 'https://sandbox.boletobancario.com/authorization-server/',
            'production' => 'https://api.juno.com.br/authorization-server/',
        ],

        // Number of seconds to wait while trying to connect to a server. 0 waits indefinitely.
        'connect_timeout' => 2.0,

        // Time needed to throw a timeout exception after a request is made.
        'timeout' => 0.0,

        // Set this to true if you want to debug the request/response.
        'debug' => false,
    ],

    // Juno's API version.
    'version' => 2,

    // Can be 'sandbox' or 'production'.
    'environment' => 'sandbox',

    // Defines if the logging should be enabled or not. If set to true, every the log entry will be sent to Laravel's
    // default logging output.
    'logging' => false,

    // Juno's API is currently unstable and being so, is common that we need to perform a request more than one time
    // until the request succeeds. Choose a value that you think that is acceptable. If the request fails even after the
    // N times set, an exception will be thrown.
    'request_max_attempts' => 10,

    // Time in ms to wait before trying to execute a new request attempt.
    'request_attempt_delay' => 500
];
