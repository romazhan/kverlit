<?php

namespace Kverlit\Abstract;

use Kverlit\Abstract\Interface\IRepository;

use mysqli;

abstract class Repository implements IRepository {
    protected mysqli $db;

    public function __construct() {
        $this->db = new mysqli(
            getenv('DB_HOSTNAME'), getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'), getenv('DB_DATABASE')
        );
    }
}
