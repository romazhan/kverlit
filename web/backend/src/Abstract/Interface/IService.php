<?php

namespace Kverlit\Abstract\Interface;

interface IService {
    public function __construct(IRepository $controller);
}
