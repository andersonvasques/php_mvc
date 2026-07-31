<?php

namespace App\Core;

use App\Controllers\Errors\HttpErrorController;

class Controller
{
    protected function view(string $view, array | object $viewData = []): void
    {
        extract($viewData);

        $viewFile = __DIR__ .  '/../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            $errorController = new HttpErrorController();
            $errorController->errorNotFound();
            return;
        }

        require_once $viewFile;
    }
}
