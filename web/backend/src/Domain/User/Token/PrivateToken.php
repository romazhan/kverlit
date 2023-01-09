<?php

namespace Kverlit\Domain\User\Token;

final class PrivateToken {
    private const DEVIDER = ':';

    public static function generate(int $accountId, string $passwordHash): string {
        return $accountId . self::DEVIDER . $passwordHash;
    }

    public static function parse(string $token): array {
        return explode(self::DEVIDER, $token);
    }

    public static function validate(string $token, int $accountId, string $passwordHash): bool {
        $parsedToken = self::parse($token);

        return (
            (int)$parsedToken[0] === $accountId &&
            $parsedToken[1] === $passwordHash
        );
    }
}
