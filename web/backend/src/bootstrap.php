<?php

use Dotenv\Dotenv;
use Kverlit\Http\Request;

Dotenv::createUnsafeImmutable(__DIR__)->load();

if(in_array(getenv('APP_DEBUG'), ['false', '0'], true)) {
    ini_set('display_errors', 0);
    error_reporting(E_ALL);
}

return function(Request $request, array $routes): int {
    if(!$action = $request->get('action')) {
        $action = 'default';
    }

    $file_path = $routes[$action];

    if(file_exists($file_path)) {
        return require_once($file_path);
    }

    throw new Exception("Action '$action' not found");
};
