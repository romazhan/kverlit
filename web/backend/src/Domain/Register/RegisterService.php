<?php

namespace Kverlit\Domain\Register;

use Kverlit\Domain\User\User;
use Kverlit\Http\Request;

final class RegisterService {
    public function __construct(
        private RegisterRepository $registerRepository
    ) {
        $this->registerRepository->setTableName('accounts');
    }

    public function register(Request $request): ?User {
        if(RegisterValidator::validate($request)) {
            if($this->registerRepository->usernameExists($request->get('username'))) {
                return null;
            }

            if($accountData = $this->registerRepository->register(
                $request->get('username'),
                password_hash(
                    $request->get('password'), PASSWORD_DEFAULT
                )
            )) {
                return User::fromArray($accountData);
            }
        }

        return null;
    }
}
