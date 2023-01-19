<?php

use Kverlit\Domain\User\{
    UserMiddleware,
    UserController,
    UserService,
    UserRepository,
    User
};
use Kverlit\Http\{
    Request,
    Response
};

$userRepository = new UserRepository();

$userMiddleware = new UserMiddleware($userRepository);
$userMiddleware->handle(new Request(),
    function(array $accountData, Request $request) use($userRepository): void {
        $userController = new UserController(
            new UserService($userRepository, User::fromArray($accountData))
        );

        $response = null;

        switch($request->get('needle')) {
            case 'validatePrivateToken':
                $response = Response::create([
                    'message' => 'Private token is valid'
                ]);
                break;

            case 'getUserInfo':
                $response = $userController->getUserInfo($request);
                break;

            default:
                $response = Response::create([
                    'message' => 'Invalid needle'
                ], 400);
        }

        $response->send();
    }
);
