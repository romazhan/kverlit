<?php

use Kverlit\Domain\User\UserMiddleware;
use Kverlit\Domain\User\UserController;
use Kverlit\Domain\User\UserService;
use Kverlit\Domain\User\UserRepository;
use Kverlit\Domain\User\User;
use Kverlit\Http\Request;
use Kverlit\Http\Response;

$userRepository = new UserRepository();

(new UserMiddleware($userRepository))->handle(new Request(),
    function(Request $request, array $accountData) use($userRepository) {
        $userController = new UserController(
            new UserService($userRepository,
                User::fromArray($accountData)
            )
        );

        switch($request->get('needle')) {
            case 'validatePrivateToken':
                Response::send([
                    'message' => 'Private token is valid'
                ]);
                break;

            case 'getUserInfo':
                $userController->getUserInfo($request);
                break;

            default:
                Response::send([
                    'message' => 'Invalid needle'
                ], 400);
        }
    }
);
