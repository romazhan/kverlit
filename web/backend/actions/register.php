<?php

use Kverlit\Domain\Register\RegisterController;
use Kverlit\Domain\Register\RegisterService;
use Kverlit\Domain\Register\RegisterRepository;
use Kverlit\Http\Request;

$registerController = new RegisterController(
    new RegisterService(new RegisterRepository())
);

$response = $registerController->register(new Request());
$response->send();
