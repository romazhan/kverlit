<?php

namespace Kverlit\Abstract;

use mysqli;

abstract class Repository {
    protected mysqli $db;

    public function __construct() {
        $this->db = new mysqli(
            getenv('DB_HOSTNAME'), getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'), getenv('DB_DATABASE')
        );
    }
}
