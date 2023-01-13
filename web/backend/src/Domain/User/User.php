<?php

namespace Kverlit\Domain\User;

use Kverlit\Domain\User\Token\PrivateToken;

final class User {
    private function __construct(
        public int $id,
        public string $username,
        public string $passwordHash,
        public string $createdAt,
        public string $privateToken
    ) {}

    public static function fromArray(array $accountData): User {
        return new static(
            $accountData['id'],
            $accountData['username'],
            $accountData['password_hash'],
            $accountData['created_at'],
            PrivateToken::generate(
                $accountData['id'],
                $accountData['password_hash']
            )
        );
    }
}
