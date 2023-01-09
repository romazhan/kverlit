<?php

use Kverlit\Domain\User\UserController;

use Kverlit\Http\Request;
use Kverlit\Http\Response;

$request = new Request();
$userController = new UserController();

switch($request->get('needle')) {
    case 'validatePrivateToken':
        $userController->validatePrivateToken($request);
        break;
    default:
        Response::send([
            'message' => 'Invalid needle'
        ], 400);
}
