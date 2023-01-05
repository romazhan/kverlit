<?php declare(strict_types = 1);

use Kverlit\Http\Request;

require_once(__DIR__ . '/vendor/autoload.php');

$bootstrap = require_once(__DIR__ . '/src/bootstrap.php');
$bootstrap(__DIR__ . '/actions', new Request());
