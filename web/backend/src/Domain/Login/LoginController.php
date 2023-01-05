<?php

namespace Kverlit\Domain\Login;

use Kverlit\Abstract\Interface\IController;

use Kverlit\Http\Request;
use Kverlit\Http\Response;

final class LoginController implements IController {
    public function login(Request $request): void {
        $loginService = new LoginService(
            new LoginRepository()
        );

        if($loginService->login(
            $request->get('login'), $request->get('password')
        )) {
            Response::send(['message' => 'Login successful']);
        } else {
            Response::send(['message' => 'Login failed'], 401);
        }
    }
}
