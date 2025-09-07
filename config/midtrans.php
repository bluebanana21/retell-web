<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),

    /**
     * Set to true for production environment.
     */
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    /**
     * Set sanitization to true.
     */
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),

    /**
     * Set 3DS transaction for credit card to true.
     */
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
];
