<?php

namespace Kverlit\Domain\Login;

use Kverlit\Abstract\Interface\IService;
use Kverlit\Abstract\Interface\IRepository;

final class LoginService implements IService {
    public function __construct(
        private IRepository $loginRepository
    ) {}

    public function login(string $login, string $password): bool {
        return false;
    }
}
