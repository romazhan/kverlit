<?php

use Kverlit\Domain\Login\LoginController;
use Kverlit\Domain\Login\LoginService;
use Kverlit\Domain\Login\LoginRepository;
use Kverlit\Http\Request;

$loginController = new LoginController(
    new LoginService(new LoginRepository())
);

$response = $loginController->login(new Request());
$response->send();
