<?php

namespace Kverlit\Domain\Register;

use Kverlit\Domain\User\Token\PrivateToken;

use Kverlit\Http\Request;

final class RegisterService {
    public function __construct(
        private RegisterRepository $registerRepository = new RegisterRepository()
    ) {}

    public function register(Request $request): bool {
        if(RegisterValidator::validate($request)) {
            if($this->registerRepository->usernameExists($request->get('username'))) {
                return false;
            }

            return $this->registerRepository->register(
                $request->get('username'),
                password_hash(
                    $request->get('password'), PASSWORD_DEFAULT
                )
            );
        }

        return false;
    }

    public function getPrivateToken(): string {
        return PrivateToken::generate(
            $this->registerRepository->getAccountId(),
            $this->registerRepository->getPasswordHash()
        );
    }
}
