<?php

namespace Kverlit\Domain\Register;

use Kverlit\Http\Request;

final class RegisterService {
    public function __construct(
        private RegisterRepository $registerRepository
    ) {}

    public function register(Request $request): bool {
        // TODO: validate request

        return false;
    }
}
