<?php

namespace Kverlit\Domain\Login;

use Kverlit\Http\{
    Request,
    Response
};

final class LoginController {
    public function __construct(
        private LoginService $loginService
    ) {}

    public function login(Request $request): Response {
        if($user = $this->loginService->login(
            $request->get('username'), $request->get('password')
        )) {
            return Response::create([
                'message' => 'Login successful',
                'userData' => $user
            ]);
        }

        return Response::create([
            'message' => 'Login failed'
        ], 401);
    }
}
