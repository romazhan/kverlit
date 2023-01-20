<?php declare(strict_types = 1);

use Kverlit\Http\{
    Request,
    Response
};

require_once(__DIR__ . '/vendor/autoload.php');

$main = function(Request $request): void {
    $bootstrap = require_once(__DIR__ . '/src/bootstrap.php');

    $bootstrap($request, [
        '_' => 'actions/_.php',
        'login' => 'actions/login.php',
        'register' => 'actions/register.php',
        'user' => 'actions/user.php'
    ]);
};

try {
    $main(new Request());
} catch(Exception) {
    Response::create([
        'message' => 'Internal server error'
    ], 500)->send();
}
