<?php

use Kverlit\Domain\Register\{
    RegisterController,
    RegisterService,
    RegisterRepository
};
use Kverlit\Http\Request;

$registerController = new RegisterController(
    new RegisterService(new RegisterRepository())
);

$response = $registerController->register(new Request());
$response->send();
