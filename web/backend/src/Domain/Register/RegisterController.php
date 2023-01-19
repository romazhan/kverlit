<?php

namespace Kverlit\Domain\Register;

use Kverlit\Http\{
    Request,
    Response
};

final class RegisterController {
    public function __construct(
        private RegisterService $registerService
    ) {}

    public function register(Request $request): Response {
        if($user = $this->registerService->register($request)) {
            return Response::create([
                'message' => 'User registered successfully',
                'userData' => $user
            ]);
        }

        return Response::create([
            'message' => 'The username is already taken'
        ], 400);
    }
}
