<?php

PHP_OS == "Windows" || PHP_OS == "WINNT" ? define("SEPARATOR", "\\") : define("SEPARATOR", "/"); 

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path == '/') {
    readfile(__DIR__ . SEPARATOR . 'main.html');
} else if (preg_match('/\.(?:png|jpg|jpeg|gif|js|css)$/', $_SERVER["REQUEST_URI"])) {
    readfile(__DIR__ . SEPARATOR . $_SERVER["REQUEST_URI"]);
} else {
    include __DIR__ . SEPARATOR . '..' . SEPARATOR . 'src' . SEPARATOR . 'backend.php';
}