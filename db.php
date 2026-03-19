<?php
require_once __DIR__ . '/config.php';

function get_db(): mysqli
{
    $host = defined('DB_HOST') ? DB_HOST : ($GLOBALS['DB_HOST'] ?? 'localhost');
    $user = defined('DB_USER') ? DB_USER : ($GLOBALS['DB_USER'] ?? 'root');
    $pass = defined('DB_PASS') ? DB_PASS : ($GLOBALS['DB_PASS'] ?? '');
    $name = defined('DB_NAME') ? DB_NAME : ($GLOBALS['DB_NAME'] ?? '');

    $conn = new mysqli($host, $user, $pass, $name);

    if ($conn->connect_error) {
        die('Database connection failed: ' . htmlspecialchars($conn->connect_error));
    }

    $conn->set_charset('utf8mb4');

    return $conn;
}