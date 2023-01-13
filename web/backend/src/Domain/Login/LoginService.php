<?php

namespace Kverlit\Domain\Login;

use Kverlit\Domain\User\User;

final class LoginService {
    public function __construct(
        private LoginRepository $loginRepository
    ) {}

    public function login(string $username, string $password): ?User {
        $accountData = $this->loginRepository->getByUsername($username);

        if(!$accountData || !password_verify($password, $accountData['password_hash'])) {
            return null;
        }

        return User::fromArray($accountData);
    }
}
