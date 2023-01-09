<?php

namespace Kverlit\Domain\Register;

use Kverlit\Http\Request;

final class RegisterValidator {
    private const USERNAME_RANGE = [2, 39];
    private const USERNAME_REGEX = '/^[a-zA-Z0-9_]+$/';

    private const PASSWORD_RANGE = [7, INF - 1];

    public static function validate(Request $request): bool {
        if($request->has('username') && $request->has('password')) {
            return (
                self::validateUsername($request->get('username')) &&
                self::validatePassword($request->get('password'))
            );
        }

        return false;
    }

    private static function validateUsername(string $username): bool {
        return (
            strlen($username) >= self::USERNAME_RANGE[0] &&
            strlen($username) <= self::USERNAME_RANGE[1] &&
            preg_match(self::USERNAME_REGEX, $username)
        );
    }

    private static function validatePassword(string $password): bool {
        return (
            strlen($password) >= self::PASSWORD_RANGE[0] &&
            strlen($password) <= self::PASSWORD_RANGE[1]
        );
    }
}
