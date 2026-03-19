<?php
require_once __DIR__ . '/config.php';

function require_role(string $role): void
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header('Location: index.php?route=auth/login');
        exit;
    }
}

