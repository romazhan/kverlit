<?php

namespace Kverlit\Abstract\Interface;

use Kverlit\Http\Request;
use Closure;

interface IMiddleware {
    public function handle(Request $request, Closure $next): mixed;
}
