<?php

namespace Kverlit\Domain\User;

final class UserService {
    public function __construct(
        private UserRepository $userRepository,
        private User $user
    ) {}

    public function getUserInfo(): User {
        return $this->user;
    }
}
