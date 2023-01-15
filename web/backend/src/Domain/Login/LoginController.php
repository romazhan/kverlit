<?php

namespace Kverlit\Domain\Login;

use Kverlit\Http\Request;
use Kverlit\Http\Response;

final class LoginController {
    public function __construct(
        private LoginService $loginService
    ) {}

    public function login(Request $request): void {
        if($user = $this->loginService->login(
            $request->get('username'), $request->get('password')
        )) {
            Response::send([
                'message' => 'Login successful',
                'userData' => $user
            ]);
        } else {
            Response::send([
                'message' => 'Login failed'
            ], 401);
        }
    }
}
