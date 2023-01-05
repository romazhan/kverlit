<?php

namespace Kverlit\Http;

final class Response {
    public static function send(array $data = [], int $code = 200): void {
        http_response_code($code);
        header('Content-Type: application/json');

        echo json_encode($data);
    }
}
