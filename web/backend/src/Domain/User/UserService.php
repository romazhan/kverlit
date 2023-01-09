<?php

namespace Kverlit\Domain\User;

use Kverlit\Domain\User\Token\PrivateToken;

final class UserService {
    public function __construct(
        private UserRepository $userRepository = new UserRepository()
    ) {
        $this->userRepository->setTableName('accounts');
    }

    public function validatePrivateToken(string $privateToken): bool {
        [$accountId, $_] = PrivateToken::parse($privateToken);

        if($accountData = $this->userRepository->getById($accountId)) {
            return PrivateToken::validate(
                $privateToken, $accountData['id'], $accountData['password_hash']
            );
        }

        return false;
    }
}
