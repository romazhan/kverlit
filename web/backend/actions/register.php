<?php

use Kverlit\Domain\Register\RegisterController;
use Kverlit\Domain\Register\RegisterService;
use Kverlit\Domain\Register\RegisterRepository;
use Kverlit\Http\Request;

(new RegisterController(new RegisterService(
    new RegisterRepository()
)))->register(new Request());
