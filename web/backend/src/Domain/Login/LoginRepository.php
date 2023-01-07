<?php

namespace Kverlit\Domain\Login;

use Kverlit\Abstract\Repository;

final class LoginRepository extends Repository {
    public function login(string $username, string $password): bool {
        $stmt = $this->db->prepare('SELECT * FROM `accounts` WHERE `username` = ? LIMIT 1;');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        
        $result = $stmt->get_result()->fetch_assoc();

        if($result && password_verify($password, $result['password_hash'])) {
            return true;
        }

        return false;
    }
}
