<?php

namespace Kverlit\Abstract\Interface;

use Kverlit\Http\Request;

interface IValidator {
    public static function validate(Request $request): bool;
}
