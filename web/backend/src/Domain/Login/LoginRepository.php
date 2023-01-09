<?php

namespace Kverlit\Domain\Login;

use Kverlit\Abstract\Repository;

final class LoginRepository extends Repository {
    private ?int $accountId = null;
    private ?string $passwordHash = null;

    public function login(string $username, string $password): string {
        $stmt = $this->db->prepare('SELECT * FROM `accounts` WHERE `username` = ? LIMIT 1;');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        
        $result = $stmt->get_result()->fetch_assoc();

        if($result && password_verify($password, $result['password_hash'])) {
            $this->accountId = $result['id'];
            $this->passwordHash = $result['password_hash'];

            return true;
        }

        return false;
    }

    public function getAccountId(): ?int {
        return $this->accountId;
    }

    public function getPasswordHash(): ?string {
        return $this->passwordHash;
    }
}
