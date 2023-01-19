<?php

use Kverlit\Domain\Login\{
    LoginController,
    LoginService,
    LoginRepository
};
use Kverlit\Http\Request;

$loginController = new LoginController(
    new LoginService(new LoginRepository())
);

$response = $loginController->login(new Request());
$response->send();
