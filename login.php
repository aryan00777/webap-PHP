<?php
// Simple redirect so old URL still works; MVC login is handled by AuthController.
header('Location: index.php?route=auth/login');
exit;

