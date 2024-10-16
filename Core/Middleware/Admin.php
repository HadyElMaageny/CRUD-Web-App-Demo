<?php

namespace Core\Middleware;

class Admin
{
    public function handle()
    {
        if (! ($_SESSION['user']['role_id'] == 1)) {
            header('Location: /');
            exit();
        }
    }
}