<?php

namespace Kverlit\Domain\Login;

use Kverlit\Http\Request;
use Kverlit\Http\Response;

final class LoginController {
    public function login(Request $request): void {
        $loginService = new LoginService();

        if($loginService->login(
            $request->get('username'), $request->get('password')
        )) {
            Response::send([
                'message' => 'Login successful',
                'privateToken' => $loginService->getPrivateToken()
            ]);
        } else {
            Response::send([
                'message' => 'Login failed'
            ], 401);
        }
    }
}
