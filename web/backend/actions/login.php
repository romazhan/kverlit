<?php

use Kverlit\Domain\Login\LoginController;
use Kverlit\Http\Request;

$loginController = new LoginController();
$loginController->login(new Request());
