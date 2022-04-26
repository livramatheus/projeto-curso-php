<?php

require __DIR__ . '/vendor/autoload.php';

$page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);
$dir  = './pages/' .$page. '.php';

if (file_exists($dir)) {
    require_once $dir;
} else {
    require_once './pages/home.php';
}