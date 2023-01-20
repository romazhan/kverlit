<?php

use Kverlit\Http\Response;

Response::create([
    'message' => 'Non-existent action'
], 404)->send();
