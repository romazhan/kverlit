<?php

namespace Kverlit\Domain\Register;

use Kverlit\Abstract\Repository;

final class RegisterRepository extends Repository {
    public function usernameExists(string $username): bool {
        $stmt = $this->db->prepare('SELECT * FROM `accounts` WHERE `username` = ? LIMIT 1;');
        $stmt->bind_param('s', $username);
        $stmt->execute();

        return $stmt->get_result()->num_rows === 1;
    }

    public function register(string $username, string $password_hash): ?array {
        $stmt = $this->db->prepare('INSERT INTO `accounts` (`username`, `password_hash`) VALUES (?, ?);');
        $stmt->bind_param('ss', $username, $password_hash);
        $stmt->execute();

        if($stmt->affected_rows === 1) {
            return $this->getById($this->db->insert_id);
        }

        return null;
    }
}
