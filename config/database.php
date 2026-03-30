<?php

$env = parse_ini_file(__DIR__ . '/../.env');

$host = $env['DB_HOST'];
$db   = $env['DB_NAME'];
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];
$port = $env['DB_PORT'];

$conn = new mysqli($host, $user, $pass, $db, $port);

$conn->set_charset("utf8mb4");