<?php

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            echo 'View not found: ' . htmlspecialchars($view);
            return;
        }
        include $viewFile;
    }
}

