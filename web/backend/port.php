<?php declare(strict_types = 1);

use Kverlit\Http\Request;
use Kverlit\Http\Response;

require_once(__DIR__ . '/vendor/autoload.php');

$main = function(Request $request): void {
    $bootstrap = require_once(__DIR__ . '/src/bootstrap.php');

    $bootstrap($request, [
        'login' => 'actions/login.php',
        'register' => 'actions/register.php',
        'user' => 'actions/user.php'
    ]);
};

try {
    $main(new Request());
} catch(Exception $e) {
    die(Response::send([
        'message' => $e->getMessage()
    ], 500));
}
