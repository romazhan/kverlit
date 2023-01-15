<?php

namespace Kverlit\Abstract;

use mysqli;

abstract class Repository {
    protected mysqli $db;
    protected string $tableName;

    public function __construct() {
        $this->db = new mysqli(
            getenv('DB_HOSTNAME'), getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'), getenv('DB_DATABASE'),
            getenv('DB_PORT')
        );
        $this->db->set_charset('utf8mb4');
    }

    public function __destruct() {
        $this->db->close();
    }

    public function getTableName(): string {
        return $this->tableName;
    }

    public function setTableName(string $tableName): void {
        $this->tableName = $tableName;
    }

    public function getById(int $id): ?array {
        $query = $this->db->prepare('SELECT * FROM `' . $this->getTableName() . '` WHERE `id` = ? LIMIT 1;');
        $query->bind_param('i', $id);
        $query->execute();

        return $query->get_result()->fetch_assoc();
    }
}
