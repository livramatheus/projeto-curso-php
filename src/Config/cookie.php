<?php

namespace Src\Config\Cookie;

if (!isset($_COOKIE['isLight'])) {
    setcookie("isLight", 'true');
}