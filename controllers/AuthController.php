<?php
require_once __DIR__ . '/../core\Controller.php';
require_once __DIR__ . '/../config.php';

class AuthController extends Controller
{
    public function login(): void
    {
        if (isset($_SESSION['username'], $_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                header('Location: index.php?route=admin/dashboard');
                exit;
            }
            if ($_SESSION['role'] === 'teacher') {
                header('Location: index.php?route=teacher/dashboard');
                exit;
            }
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = strtolower(trim($_POST['username'] ?? ''));
            $password = trim($_POST['password'] ?? '');

            global $USERS;
            $configuredUsers = is_array($USERS ?? null) ? $USERS : [];
            $fallbackUsers = [
                'admin' => [
                    'password' => 'admin123',
                    'role' => 'admin',
                ],
                'teacher1' => [
                    'password' => 'teacher123',
                    'role' => 'teacher',
                    'staff_id' => 1,
                ],
            ];
            $users = array_replace($fallbackUsers, $configuredUsers);

            if (isset($users[$username]) && ($users[$username]['password'] ?? '') === $password) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $users[$username]['role'];
                if ($_SESSION['role'] === 'teacher' && isset($users[$username]['staff_id'])) {
                    $_SESSION['staff_id'] = (int)$users[$username]['staff_id'];
                } elseif ($_SESSION['role'] === 'teacher') {
                    // Fallback for demo users without explicit staff mapping.
                    $_SESSION['staff_id'] = 1;
                }

                if ($_SESSION['role'] === 'admin') {
                    header('Location: index.php?route=admin/dashboard');
                } else {
                    header('Location: index.php?route=teacher/dashboard');
                }
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        }

        $this->view('auth/login', [
            'page_title' => 'Tech Hub - Login',
            'error' => $error,
        ]);
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        header('Location: index.php?route=auth/login');
        exit;
    }
}

