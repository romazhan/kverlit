<?php

namespace Kverlit\Http;

final class Request { // TODO: as an entity?
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

    public function has(string $key): bool {
        return isset($this->request[$key]);
    }
}
