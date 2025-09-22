<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Jen-UI Prefix
    |--------------------------------------------------------------------------
    |
    | This option controls the prefix that will be used for all Jen-UI
    | components. You can set it to empty string to use components without
    | prefix like <x-button> or set custom prefix like 'jen-' for <x-jen-button>.
    |
    */
    'prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Component Auto-Discovery
    |--------------------------------------------------------------------------
    |
    | When enabled, Jen-UI will automatically discover and register all
    | components using namespace-based discovery for better performance.
    |
    */
    'auto_discovery' => true,

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | This option controls the route prefix that will be used for all Jen-UI
    | internal routes like upload endpoints. Set to empty string for no prefix.
    |
    */
    'route_prefix' => '',
];
