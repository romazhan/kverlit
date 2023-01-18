<?php

namespace Kverlit\Http;

final class Response {
    private function __construct(
        private array $data = [],
        private int $code = 200
    ) {}

    public static function create(array $data = [], int $code = 200): Response {
        return new self($data, $code);
    }

    public function send(): void {
        http_response_code($this->code);
        header('Content-Type: application/json');

        echo json_encode($this->data);
    }
}
