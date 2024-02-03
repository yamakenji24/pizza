<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

call_user_func(require_once __DIR__ . '/../src/Routes/api.php', $_SERVER['REQUEST_URI']);
