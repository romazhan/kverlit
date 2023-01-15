<?php

namespace Kverlit\Domain\Register;

use Kverlit\Http\Request;
use Kverlit\Http\Response;

final class RegisterController {
    public function __construct(
        private RegisterService $registerService
    ) {}

    public function register(Request $request): void {
        if($user = $this->registerService->register($request)) {
            Response::send([
                'message' => 'User registered successfully',
                'userData' => $user
            ]);
        } else {
            Response::send([
                'message' => 'The username is already taken'
            ], 400);
        }
    }
}
