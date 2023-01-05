<?php

namespace Kverlit\Http;

final class Request {
    private array $request;

    public function __construct() {
        $this->request = [...$_GET, ...$_POST];
    }

    public function get(string $key = null): mixed {
        if($key === null) {
            return $this->request;
        }

        return $this->request[$key] ?? null;
    }
}
