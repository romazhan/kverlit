<?php

namespace Kverlit\Domain\Register;

use Kverlit\Http\Request;
use Kverlit\Http\Response;

final class RegisterController {
    public function register(Request $request): void {
        $register = new RegisterService(
            new RegisterRepository()
        );

        if($register->register($request)) {
            Response::send([
                'message' => 'User registered successfully'
            ]);
        } else {
            Response::send([
                'message' => 'User registration failed'
            ], 400);
        }
    }
}
