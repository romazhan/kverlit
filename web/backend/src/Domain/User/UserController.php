<?php

namespace Kverlit\Domain\User;

use Kverlit\Http\Request;
use Kverlit\Http\Response;

final class UserController {
    public function __construct(
        private UserService $userService
    ) {}

    public function getUserInfo(Request $request): Response {
        return Response::create([
            'message' => 'User info',
            'userData' => $this->userService->getUserInfo($request)
        ]);
    }
}
