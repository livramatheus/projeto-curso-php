<?php

require __DIR__ . '/vendor/autoload.php';

$p   = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);
$dir = './pages/' .$p. '.php';

if (file_exists($dir)) {
    require_once $dir;
} else {
    require_once './pages/home.php';
}