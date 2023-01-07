<?php

namespace Kverlit\Domain\Login;

final class LoginService {
    public function __construct(
        private LoginRepository $loginRepository
    ) {}

    public function login(string $username, string $password): bool {
        return $this->loginRepository->login($username, $password);
    }
}
