<?php

namespace Kverlit\Domain\User;

use Kverlit\Abstract\Interface\IMiddleware;
use Kverlit\Domain\User\Token\PrivateToken;
use Kverlit\Http\Request;
use Kverlit\Http\Response;
use Closure;

final class UserMiddleware implements IMiddleware {
    public function __construct(
        private UserRepository $userRepository
    ) {
        $this->userRepository->setTableName('accounts');
    }

    public function handle(Request $request, Closure $next): mixed {
        $privateToken = $request->get('privateToken');
        $accountId = PrivateToken::parse($privateToken)[0];

        $accountData = $this->userRepository->getById($accountId);

        if(!$accountData ||
            !PrivateToken::validate(
                $privateToken, $accountData['id'], $accountData['password_hash']
            )
        ) {
            return Response::send([
                'message' => 'Invalid private token'
            ], 400);
        }

        return $next($accountData, $request);
    }
}
