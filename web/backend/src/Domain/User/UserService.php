<?php

namespace Kverlit\Domain\User;

final class UserService {
    public function __construct(
        private UserRepository $userRepository,
        private User $user
    ) {
        $this->userRepository->setTableName('accounts');
    }

    public function getUserInfo(): array {
        return [
            'id' => $this->user->id,
            'username' => $this->user->username,
            'regDate' => $this->user->createdAt
        ];
    }
}
