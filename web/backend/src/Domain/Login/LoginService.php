<?php

namespace Kverlit\Domain\Login;

use Kverlit\Domain\User\Token\PrivateToken;

final class LoginService {
    public function __construct(
        private LoginRepository $loginRepository = new LoginRepository()
    ) {}

    public function login(string $username, string $password): bool {
        return $this->loginRepository->login($username, $password);
    }

    public function getPrivateToken(): string {
        return PrivateToken::generate(
            $this->loginRepository->getAccountId(),
            $this->loginRepository->getPasswordHash()
        );
    }
}
