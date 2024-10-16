<?php

namespace Core\Middleware;

class Admin
{
    public function handle()
    {
        if (! $_SESSION['user']['admin'] ?? false) {
            header('Location: /');
            exit();
        }
    }
}