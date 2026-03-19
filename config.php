<?php
// Database configuration for XAMPP (MySQL)
// CHANGE these values to match your local setup.

$DB_HOST = 'localhost';
$DB_NAME = 'student_course_hub';
$DB_USER = 'root';
$DB_PASS = '';

// Constants used by db.php (compatibility with existing models/controllers).
if (!defined('DB_HOST')) {
    define('DB_HOST', $DB_HOST);
}
if (!defined('DB_NAME')) {
    define('DB_NAME', $DB_NAME);
}
if (!defined('DB_USER')) {
    define('DB_USER', $DB_USER);
}
if (!defined('DB_PASS')) {
    define('DB_PASS', $DB_PASS);
}

// Simple demo users (change passwords / usernames as you like)
// In a real project these would be stored in the database with hashed passwords.
$USERS = [
    'admin' => [
        'password' => 'admin123',
        'role' => 'admin',
    ],
    'teacher1' => [
        'password' => 'teacher123',
        'role' => 'teacher',
        // This StaffID is used to link to the Staff table
        'staff_id' => 1,
    ],
];

session_start();
