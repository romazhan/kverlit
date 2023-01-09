<?php

namespace Kverlit\Domain\Register;

use Kverlit\Http\Request;
use Kverlit\Http\Response;

final class RegisterController {
    public function register(Request $request): void {
        $registerService = new RegisterService();

        if($registerService->register($request)) {
            Response::send([
                'message' => 'User registered successfully',
                'privateToken' => $registerService->getPrivateToken()
            ]);
        } else {
            Response::send([
                'message' => 'The username is already taken'
            ], 400);
        }
    }
}
