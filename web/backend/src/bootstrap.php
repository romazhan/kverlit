<?php

use Kverlit\Http\Request;
use Dotenv\Dotenv;

Dotenv::createUnsafeImmutable(__DIR__)->load();

return function(string $dir, Request $request): int {
    if(!$action = $request->get('action')) {
        $action = 'default';
    }

    $file_path = "$dir/$action.php";

    if(file_exists($file_path)) {
        return require_once($file_path);
    }

    throw new Exception("Action '$action' not found");
};
