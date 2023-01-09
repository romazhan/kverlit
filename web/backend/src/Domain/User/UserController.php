<?php

namespace Kverlit\Domain\User;

use Kverlit\Http\Request;
use Kverlit\Http\Response;

final class UserController {
    public function validatePrivateToken(Request $request): void {
        $userService = new UserService();

        if($userService->validatePrivateToken($request->get('privateToken'))) {
            Response::send([
                'message' => 'Private token is valid'
            ]);
        } else {
            Response::send([
                'message' => 'Private token is invalid'
            ], 400);
        }
    }
}
