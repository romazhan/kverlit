<?php

use Kverlit\Domain\Login\LoginController;
use Kverlit\Domain\Login\LoginService;
use Kverlit\Domain\Login\LoginRepository;
use Kverlit\Http\Request;

(new LoginController(new LoginService(
    new LoginRepository()
)))->login(new Request());
