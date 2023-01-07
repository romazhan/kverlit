<?php

use Kverlit\Domain\Register\RegisterController;
use Kverlit\Http\Request;

$registerController = new RegisterController();
$registerController->register(new Request());
