<?php

namespace Kverlit\Domain\Login;

use Kverlit\Abstract\Repository;

final class LoginRepository extends Repository {
    public function getByUsername(string $username): array {
        $stmt = $this->db->prepare('SELECT * FROM `accounts` WHERE `username` = ? LIMIT 1;');
        $stmt->bind_param('s', $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }
}
